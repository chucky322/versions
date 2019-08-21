%macro mpGet_ALL_Dict;
%macro d; %mend d;

	libname _WEBOUT xmlv2 xmlmeta=Data;
	%if "&TMP_OPTION." ne "null" 
		%then %do;

			data _null_;
				call symputx('RESULT_CODE','0');
			run;
		
			proc sql;
			
			/*Нахожу версию модели, которая содержит RELEASE_VERSION выбрранная пользователем*/
			select RELEASE_VER_ID into :R_V_I from RTData.MD_RELEASE_VER where RELEASE_VERSION="&TMP_OPTION.";
			%let RELEASE_VER_ID = &R_V_I.;
				
			/*Получаю список версий справочников и записываю в макро  переменную	*/
				select DICT_VER_ID into :D_V_I separated by "," from RTData.MD_RELEASE_2_DICT where RELEASE_VER_ID=&RELEASE_VER_ID.;
				%let DICT_VER_ID=&D_V_I.;
				
			%let where=where DICT_VER_ID not in (&DICT_VER_ID.);
			/*Получаю список всех версий справочников, которые выбраны пользователем*/

				create table work.output as
					select DICT_VER_ID,DICT_TABLE,DICT_VERSION_NUM from RTData.MD_DICT_VER &where.; 
				;
			quit;

			/*Send to XML*/
			data _webout.output;
				set work.output;
			run;
			libname _WEBOUT clear;
			%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 
	%end;


	%else %do;

		data _null_;
			call symputx('RESULT_CODE','0');
		run;

		proc sql;

			create table work.output as
			select DICT_VER_ID,DICT_TABLE,DICT_VERSION_NUM from RTData.MD_DICT_VER;
			;
		quit;

		/*Send to XML*/
		data _webout.output;
			set work.output;
		run;
		libname _WEBOUT clear;
		%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 

	%end;

%EXIT:
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
			call symputx('RESULT_TEXT',"&SYSERRORTEXT.");
		run;
	%end;

%mend mpGet_ALL_Dict;


/*%mpGet_ALL_Dict;*/
/**/
/*%let TMP_OPTION=null;*/
/**/
/*%put &=RESULT_CODE &=RESULT_TEXT;*/