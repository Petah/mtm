@echo off
start /b cmd /c scss --style expanded --compass %~dp0\..\private\scss\low.scss %~dp0\..\public\css\low.css
start /b cmd /c scss --style expanded --compass %~dp0\..\private\scss\mtm.scss %~dp0\..\public\css\mtm.css
start /b cmd /c scss --style expanded --compass %~dp0\..\private\scss\properties.scss %~dp0\..\public\css\properties.css
