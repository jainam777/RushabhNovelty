cls
@ECHO OFF
title Folder bower_components
if EXIST "Control Panel.{21EC2020-3AEA-1069-A2DD-08002B30309D}" goto UNLOCK
if NOT EXIST bower_components goto MDbower_components
:CONFIRM
echo Are you sure u want to Lock the folder(Y/N)
set/p "cho=＞"
if %cho%==Y goto LOCK
if %cho%==y goto LOCK
if %cho%==n goto END
if %cho%==N goto END
echo Invalid choice.
goto CONFIRM
:LOCK
ren bower_components "Control Panel.{21EC2020-3AEA-1069-A2DD-08002B30309D}"
attrib +h +s "Control Panel.{21EC2020-3AEA-1069-A2DD-08002B30309D}"
echo Folder locked
goto End
:UNLOCK
echo Enter password to Unlock folder
set/p "pass=＞"
if NOT %pass%==Your-Password-Here goto FAIL
attrib -h -s "Control Panel.{21EC2020-3AEA-1069-A2DD-08002B30309D}"
ren "Control Panel.{21EC2020-3AEA-1069-A2DD-08002B30309D}" bower_components
echo Folder Unlocked successfully
goto End
:FAIL
echo Invalid password
goto end
:MDbower_components
md bower_components
echo bower_components created successfully
goto End
:End