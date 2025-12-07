# OpenEMR Custom Module Skeleton Starter Project
This is a sample module project that developers can clone and use to create their own custom modules inside 
the OpenEMR codebase.  These modules leverage the oe-module-install-plugin which installs the custom module
into the OpenEMR custom module installation folder.

The project has sample code that demostrates adding your module to the menu system, creating global settings,
and adding a rest api endpoint.

There are a limited number of events currently in the OpenEMR codebase, as we continue to add support for 
module writers we will add more events to the codebase.  If there is a place in the core codebase you would 
like your custom module to connect to please file an issue at [https://github.com/openemr/openemr](https://github.com/openemr/openemr)

## Getting Started
You can start by cloning the project.  When developing modules the best initial location would be to clone the directory
inside the OpenEMR custom modules location.  This is at *<openemr_installation_directory>//interface/modules/custom_modules/*
```git
git clone https://github.com/adunsulag/oe-module-custom-skeleton <your-project-name>
```

Update the composer.json file properties for your own project.

Look at src/Bootstrap.php to see how to add menu items, subscribe to system events, insert global settings, or adjust the OpenEMR api.


### Installing Module Via Composer
There are two ways to install your module via composer.  
#### Public Module
We highly encourage you to share your created modules with the OpenEMR community.  To ensure that other developers / users can install
your packages please register your module on [https://packagist.org/](https://packagist.org/).  Once your module has been registered
users can install your package by doing a `composer require "<namespace>/<your-package-name>`
#### Private Module
If your module is a private module you can still tell composer where to find your module by setting it up to use a private repository.
You can do it with the following command:
```
composer config repositories.repo-name vcs https://github.com/<organization or user name>/<repository name>
```
For example to install this skeleton as a module you can run the following
```
composer config repositories.repo-name vcs https://github.com/adunsulag/oe-module-custom-skeleton
```

At that point you can run the install command
```
composer require adunsulag/oe-module-custom-skeleton
```

### Installing Module via filesystem
If you copy your module into the installation directory you will need to copy your module's composer.json "psr-4" property into your OpenEMR's psr-4 settings.
You will also need to run a ```composer dump-autoload``` wherever your openemr composer.json file is located in order to get your namespace properties setup properly
to include your module.

### Activating Your Module
Install your module using either composer (recommended) or by placing your module in the *<openemr_installation_directory>//interface/modules/custom_modules/*.

Once your module is installed in OpenEMR custom_modules folder you can activate your module in OpenEMR by doing the following.

  1. Login to your OpenEMR installation as an administrator
  2. Go to your menu and select Modules -> Manage Modules
  3. Click on the Unregistered tab in your modules list
  4. Find your module and click the *Register* button.  This will reload the page and put your module in the Registered list tab of your modules
  5. Now click the *Install* button next your module name.
  6. Finally click the *Enable* button for your module.

## React UI Development

This module includes a modern React + TypeScript + Vite frontend setup in the `ui/` directory. The React application integrates seamlessly with OpenEMR and supports both development and production modes.

### Technology Stack
- **React 19** - Modern React with latest features
- **TypeScript** - Type-safe development
- **Vite** - Fast build tool and dev server
- **React Router** - Client-side routing with hash-based navigation
- **pnpm** - Fast, disk space efficient package manager

### Running the React App in Development Mode

1. **Navigate to the UI directory:**
   ```bash
   cd ui
   ```

2. **Install dependencies (first time only):**
   ```bash
   pnpm install
   ```

3. **Start the Vite development server:**
   ```bash
   pnpm dev
   ```
   The dev server will start at `http://localhost:5173` with Hot Module Replacement (HMR) enabled.

4. **Enable development mode in OpenEMR:**
   
   Set the environment variable `EASY_DEV_MODE=yes` and ensure development mode is enabled in your module's global settings. When in dev mode, the module will load assets from the Vite dev server instead of the built files.

### Building for Production

To create an optimized production build:

```bash
cd ui
pnpm build
```

This will:
- Compile TypeScript and bundle your React application
- Generate optimized, minified assets
- Output files to `../public/assets/react-app/` 
- Create a manifest file for asset loading

### Project Structure

```
ui/
├── src/
│   ├── main.tsx          # Application entry point with routing
│   ├── App.tsx           # Main App component
│   ├── globals.d.ts      # TypeScript global declarations
│   └── assets/           # Static assets (images, etc.)
├── public/               # Static files served as-is
├── package.json          # Dependencies and scripts
├── vite.config.ts        # Vite configuration
├── tsconfig.json         # TypeScript configuration
└── pnpm-lock.yaml        # Dependency lock file
```

### Available Routes

The React app uses hash-based routing:
- `/#/` - Main application page
- `/#/about-dev` - About developer page
- `/#/*` - 404 not found page

### Integration with OpenEMR

The React app receives OpenEMR context through `window.openemrData`:
- `user_id` - Current OpenEMR user ID
- `base_url` - OpenEMR web root
- `csrf_token` - CSRF token for API requests
- `language` - User's language preference
- `site_id` - OpenEMR site ID

## Changes and Enhancements

This fork includes the following enhancements over the original skeleton:

### React Frontend Integration
- Complete React + TypeScript + Vite setup for modern frontend development
- Development and production mode support with hot module replacement
- Hash-based routing for client-side navigation
- TypeScript type definitions for OpenEMR integration
- Build configuration optimized for OpenEMR module structure

### UI Development Workflow
- Fast development server with HMR at port 5173
- Automatic asset bundling and optimization
- Manifest-based asset loading in production
- CORS configuration for development mode
- Source maps for easier debugging

### Developer Experience
- Modern tooling with pnpm for faster installs
- ESLint configuration for code quality
- TypeScript for type safety
- React 19 with latest features
- Sample routes and components to get started quickly

## Contributing
If you would like to help in improving the skeleton library just post an issue on Github or send a pull request.

### Contributors
- **Original Author**: [adunsulag](https://github.com/adunsulag)
- **React Integration**: [Pasindu Akalpa](https://github.com/pAkalpa) - Added React + Vite setup, TypeScript configuration, and development workflow