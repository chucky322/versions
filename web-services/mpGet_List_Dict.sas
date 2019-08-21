%macro mpGet_List_Dict;
%macro d; %mend d;

	libname _WEBOUT xmlv2 xmlmeta=Data;


	data _null_;
		call symputx('RESULT_CODE','0');
	run;

	proc sql;
	/*Получаю список версий справочников и записываю в макро  переменную	*/
		select DICT_VER_ID into :D_V_I separated by "," from RTData.MD_RELEASE_2_DICT where RELEASE_VER_ID=&RELEASE_VER_ID.;
		%let DICT_VER_ID=&D_V_I.;
		
	%let where=where DICT_VER_ID in (&DICT_VER_ID.);
	/*Получаю список всех версий справочников, которые выбраны пользователем*/

		create table work.output as
			select DICT_VER_ID,DICT_TABLE,DICT_VERSION_NUM from RTData.MD_DICT_VER &where.; 
		;
	quit;

	/*Send to XML*/
	data _webout.output;
		set work.output;
	run;
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 


%EXIT:
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
			call symputx('RESULT_TEXT',"&SYSERRORTEXT.");
		run;
	%end;

%mend mpGet_List_Dict;


/*%mpGet_List_Dict;*/
/**/
/*%let RELEASE_VER_ID=2;*/
/**/
/*%put &=RESULT_CODE &=RESULT_TEXT;*/