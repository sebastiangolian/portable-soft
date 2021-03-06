; CheckForPlatformSplashDisable 1.1 (2016-11-19)
;
; Checks if the platform wants the splash screen disabled
; Copyright 2008-2016 John T. Haller of PortableApps.com
; Released under the GPL
;
; Usage: ${CheckForPlatformSplashDisable} _v
;
; Example: ${CheckForPlatformSplashDisable} $DisableSplashScreen
;    If the platform wants it disabled, $DisableSplashScreen will be true.
;    Otherwise it will be whatever its previous value was

!macro CheckForPlatformSplashDisable _v
	StrCmp ${_v} true _CFPSDEnd
		;Get the parameter and sort out the stack
		Push $0
		Push $1
		Push $R0
		
		StrCpy $0 ${_v}

		;Read from the INI
		ReadEnvStr $1 PortableApps.comDisableSplash
		StrCmp $1 true "" _CFPSDStackEnd

		${GetParent} $EXEDIR $1
		IfFileExists $1\PortableApps.com\PortableAppsPlatform.exe "" _CFPSDStackEnd

		MoreInfo::GetProductName `$1\PortableApps.com\PortableAppsPlatform.exe`
		Pop $R0
		StrCmp $R0 "PortableApps.com Platform" "" _CFPSDStackEnd

		MoreInfo::GetCompanyName `$1\PortableApps.com\PortableAppsPlatform.exe`
		Pop $R0
		StrCmp $R0 PortableApps.com "" _CFPSDStackEnd

		FindProcDLL::FindProc PortableAppsPlatform.exe ; Onto $R0
		IntCmp $R0 1 "" _CFPSDStackEnd _CFPSDStackEnd

		StrCpy $0 true

		_CFPSDStackEnd:
		; Restore the stack and sort everything out
		Pop $R0
		Pop $1
		Exch $0
		Pop ${_v}

	_CFPSDEnd:
!macroend
!define CheckForPlatformSplashDisable '!insertmacro CheckForPlatformSplashDisable'