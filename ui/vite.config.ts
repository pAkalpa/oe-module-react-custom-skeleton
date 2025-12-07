import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// https://vite.dev/config/

export default defineConfig({
  plugins: [react()],
  base: "./",
  build: {
    // Output build files to the module's public assets folder
    outDir: "../public/assets/react-app",
    emptyOutDir: true,
    manifest: true, // Important: Generate a manifest so PHP can find the hashed filenames
    rollupOptions: {
      input: "./src/main.tsx",
    },
  },
  server: {
    port: 5173,
    strictPort: true,
    origin: "http://localhost:5173",
    cors: {
      origin: "*",
      methods: ["GET", "OPTIONS"],
    },
  },
});
