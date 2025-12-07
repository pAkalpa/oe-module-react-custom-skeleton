import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Route, Routes } from "react-router";
import "./index.css";
import App from "./App.tsx";

createRoot(document.getElementById("root")!).render(
  <StrictMode>
    <HashRouter>
      <Routes>
        <Route path="/" element={<App />} />
        <Route
          path="/about-dev"
          element={
            <div>
              About Developer:{" "}
              <a
                target="_blank"
                rel="noopener noreferrer"
                href="https://github.com/pAkalpa"
              >
                Pasindu Akalpa
              </a>
            </div>
          }
        />
        <Route path="*" element={<div>404 Not Found</div>} />
      </Routes>
    </HashRouter>
  </StrictMode>
);
