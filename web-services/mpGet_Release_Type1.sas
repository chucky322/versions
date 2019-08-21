%macro mpGet_Release_Type1;
%macro d; %mend d;
	
	data _null_;
		call symputx('RESULT_CODE','0');
	run;

	/*Send XML output*/
	libname _WEBOUT xmlv2 xmlmeta=Data;

	/*get release type1*/
	proc sql;
		create table work.output as
			select 
				RELEASE_TYPE1_ID,
				RELEASE_TYPE1
			from RTData.MD_RELEASE_TYPE1 
			where ACTIVE_FLAG = 1
		;
	quit;
	
	/*Send to XML*/
	data _webout.output;
		set work.output;
	run;
	
	libname _WEBOUT clear;

%EXIT:
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
			call symputx('RESULT_TEXT',"&SYSERRORTEXT.");
		run;
	%end;

%mend mpGet_Release_Type1;


/*%mpGet_Release_Type1;*/
/**/
/*%put &=RESULT_CODE &=RESULT_TEXT;*/