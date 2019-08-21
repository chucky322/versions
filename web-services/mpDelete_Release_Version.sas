%macro mpDelete_Release_Version;
%macro d; %mend d;
	
	/*Send XML output*/
	libname _WEBOUT xmlv2 xmlmeta=Data;
	
	%let todaysDate = %sysfunc(today(), yymmddn8.);

	/*Check input parameters*/
	%if "&REQUEST_TYPE." eq "DELETE_RELEASE_VERSION"
		%then %do;

		data _null_;
			call symputx('RESULT_CODE','0');
		run;

		proc sql;
				DELETE FROM RTData.MD_RELEASE_VER WHERE RELEASE_VER_ID = &RELEASE_VER_ID.;
				DELETE FROM RTData.MD_RELEASE_VER_HIST WHERE RELEASE_VER_ID = &RELEASE_VER_ID.;
		quit;
		
		%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 
	%end;
	%else %do;
		data _null_;
			call symputx('RESULT_CODE','-2');
			call symputx('RESULT_TEXT','Wrong input parameters');
			call symputx('REQUEST_TYPE2','lslsl');
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
%mend mpDelete_Release_Version;