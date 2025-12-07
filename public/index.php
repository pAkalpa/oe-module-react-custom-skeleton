<?php

/**
 * React Application Host Page
 */

require_once "../../../../globals.php";

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Modules\CustomReactModuleSkeleton\Bootstrap;

$viteHost = '';
$isDev = false;

$tab_name = $_GET['tab_name'] ?? 'default';

$ed = $GLOBALS['kernel']->getEventDispatcher();
$bootstrap = new Bootstrap($ed);

if (getenv("EASY_DEV_MODE") === "yes" && $bootstrap->getGlobalConfig()->isDevelopmentModeEnabled()) {
    $viteHost = "http://localhost:5173";
    $isDev = true;
}

function getViteAssets($manifestPath)
{
    if (!file_exists($manifestPath)) {
        return null;
    }
    return json_decode(file_get_contents($manifestPath), true);
}

$manifestAssets = null;
if (!$isDev) {
    $manifestPath = __DIR__ . '/assets/react-app/.vite/manifest.json';
    if (!file_exists($manifestPath)) {
        $manifestPath = __DIR__ . '/assets/react-app/manifest.json';
    }
    $manifestAssets = getViteAssets($manifestPath);
}

$php_data = [
    "user_id" => $_SESSION['authUserID'] ?? null,
    'site_id' => $_SESSION['site_id'] ?? null,
    'language' => $_SESSION['language_choice'] ?? 'en',
    "csrf_token" => CsrfUtils::collectCsrfToken(),
    'base_url' => $GLOBALS['web_root'],
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenEMR React Module (<?php echo $isDev ? 'Dev' : 'Prod'; ?>) - <?php echo htmlspecialchars($tab_name); ?></title>

    <script>
        // This makes the data available globally as window.openemrData
        window.openemrData = <?php echo json_encode($php_data); ?>;
    </script>
    <?php if ($isDev): ?>

        <script type="module">
            import RefreshRuntime from '<?php echo $viteHost; ?>/@react-refresh'
            RefreshRuntime.injectIntoGlobalHook(window)
            window.$RefreshReg$ = () => {}
            window.$RefreshSig$ = () => (type) => type
            window.__vite_plugin_react_preamble_installed__ = true
        </script>

        <script type="module" src="<?php echo $viteHost; ?>/@vite/client"></script>

        <script type="module" src="<?php echo $viteHost; ?>/src/main.tsx"></script>

    <?php else: ?>
        <?php
        if ($manifestAssets && isset($manifestAssets['src/main.tsx']['css'])):
            foreach ($manifestAssets['src/main.tsx']['css'] as $cssFile): ?>
                <link rel="stylesheet" href="assets/react-app/<?php echo $cssFile; ?>">
        <?php endforeach;
        endif;
        ?>
    <?php endif; ?>
</head>

<body>
    <div id="root"></div>
    <?php if (!$isDev): ?>
        <?php if ($manifestAssets && isset($manifestAssets['src/main.tsx']['file'])): ?>
            <script type="module" src="assets/react-app/<?php echo $manifestAssets['src/main.tsx']['file']; ?>"></script>
        <?php else: ?>
            <p style="color:red; padding:20px;">
                Build assets not found. Run <code>npm run build</code> in 'ui' folder or start dev server.
            </p>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>