%macro mpChange_Code_Status;
%macro d; %mend d;
	
	/*Send XML output*/
	libname _WEBOUT xmlv2 xmlmeta=Data;
	
	
	/*Check input parameters*/
	%if "&REQUEST_TYPE." eq "ACTIVATE_RELEASE_VERSION" 
	or ("&REQUEST_TYPE." eq "CANCELED_RELEASE_VERSION" and %length(&RELEASE_VER_ID) ne 0)
	or ("&REQUEST_TYPE." eq "IN_DEV_RELEASE_VERSION" and %length(&RELEASE_VER_ID) ne 0)
		%then %do;

		data _null_;
			call symputx('RESULT_CODE','0');
		run;
		
		%let CODE_NAME=Activated;
		%let CODE_STATUS=1;
		
		%if "&REQUEST_TYPE." eq "CANCELED_RELEASE_VERSION" 
		%then %do;
			%let CODE_NAME='In Canceled';
			%let CODE_STATUS=2;
		%end;
		%if "&REQUEST_TYPE." eq "IN_DEV_RELEASE_VERSION"
		%then %do;
			%let CODE_NAME='In development';
			%let CODE_STATUS=0;
		%end;
		
		proc sql;
			UPDATE RTData.MD_RELEASE_VER SET CODE_STATUS = &CODE_STATUS. WHERE RELEASE_VER_ID = &RELEASE_VER_ID.;
			
			INSERT INTO RTData.MD_RELEASE_VER_HIST(RELEASE_VER_ID, ACTION_TYPE, ACTION_USER) VALUES (&RELEASE_VER_ID.,"&CODE_NAME.","&ACTION_USER.");
		quit;
		
		%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 
	%end;
	%else %do;
		data _null_;
			call symputx('RESULT_CODE','-2');
			call symputx('RESULT_TEXT','Wrong input parameters');
		run;
	%end;
	libname _WEBOUT clear;

%EXIT:
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
			call symputx('RESULT_TEXT',"&SYSERRORTEXT.");
		run;
	%end;
%mend mpChange_Code_Status;