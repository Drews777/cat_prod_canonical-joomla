@echo off
del AI-BOLIT-REPORT.html
copy aibolit\ai-bolit.php meister.loc\aibolit_temp.php
copy aibolit\.adirignore meister.loc\.adirignore
copy aibolit\.aignore meister.loc\.aignore
copy aibolit\.aurlignore meister.loc\.aurlignore
copy aibolit\AIBOLIT-WHITELIST.db meister.loc\AIBOLIT-WHITELIST.db

IF EXIST "%PROGRAMFILES(X86)%" (GOTO 64BIT) ELSE (GOTO 32BIT)

:64BIT
echo "Running x64"
aibolit\php55\php.exe -d short_open_tag=on meister.loc\aibolit_temp.php --mode=2 --report=..\AI-BOLIT-REPORT.html

GOTO END

:32BIT
echo "Running x86"
aibolit\php55\php.exe -d short_open_tag=on meister.loc\aibolit_temp.php --mode=2 --report=..\AI-BOLIT-REPORT.html

GOTO END

:END

del meister.loc\AI-BOLIT-DOUBLECHECK.php
del meister.loc\aibolit_temp.php
del meister.loc\.adirignore
del meister.loc\.aignore
del meister.loc\.aurlignore
del meister.loc\AIBOLIT-WHITELIST.db
echo ---------------------------------------------------------
echo Сканирование завершено. Отчет о сканировании AI-BOLIT-REPORT.html 
pause