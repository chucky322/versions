%macro mpCreate_Release_Versions;
%macro d; %mend d;
	
	/*Send XML output*/

/*	*/
	%let todaysDate = %sysfunc(DATETIME());
	%let secret_word = &todaysDate.&RELEASE_TYPE1_ID.;
	/*Check input parameters*/
	%if "&REQUEST_TYPE." eq "ADD_RELEASE_VERSION"
		%then %do;

		data _null_;
			call symputx('RESULT_CODE','0');
		run;

		proc sql;
				/*	записываю данные  в 	RTData.MD_RELEASE_VER		*/
				insert into RTData.MD_RELEASE_VER (RELEASE_VERSION, RELEASE_TYPE1_ID, CODE_STATUS, TEXT_COMMENT, secret_word) 
				VALUES("&RELEASE_VERSION.", &RELEASE_TYPE1_ID., 0, "&TEXT_COMMENT.", "&secret_word."); 
				/*		нахожу последнюю  RELEASE_VER_ID и записываю в макро переменную		*/
				select RELEASE_VER_ID into :R_I_D from RTData.MD_RELEASE_VER where secret_word = "&secret_word.";
				%let RELEASE_VER_ID = &R_I_D;
				/*записываю данные в MD_RELEASE_VER_HIST*/
				insert into RTData.MD_RELEASE_VER_HIST (RELEASE_VER_ID, ACTION_TYPE, ACTION_USER, TEXT_COMMENT)
				VALUES(&RELEASE_VER_ID.,"In development","&USER.","&TEXT_COMMENT.");
			
				/*записываю данные в MD_RELEASE_2_DICT*/
				%let word_cnt=%sysfunc(countw("&DICT_VER_ID.",%str(,)));
				%DO I = 1 %TO &word_cnt.;
					insert into RTData.MD_RELEASE_2_DICT (RELEASE_VER_ID,DICT_VER_ID,USER_INSERTED) 
					VALUES (&RELEASE_VER_ID., %scan(%bquote(&DICT_VER_ID.), &i, %str(,)), "&USER.");
				%END;

				/*нахожу записанный ALG_VER_ID*/
				select ALG_VER_ID into :A_V_I from RTData.MD_ALG_VER where SECRET_WORD = "&secret_word.";
				%let ALG_VER_ID = &A_V_I.;
				
			
				/*записываю данные в MD_RELEASE_2_ALG*/
				select ALG_VER_ID into :A_V_I from RTData.MD_ALG_VER where EVENT_NAME="&EVENT_NAME.";
				%let ALG_VER_ID=&A_V_I.;
				insert into RTData.MD_RELEASE_2_ALG (RELEASE_VER_ID,ALG_VER_ID,USER_INSERTED) 
				VALUES (&RELEASE_VER_ID., &ALG_VER_ID.,"&USER.");
		
		quit;
		%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 
	%end;
	%else %do;
		data _null_;
			call symputx('RESULT_CODE','-2');
			call symputx('RESULT_TEXT','Wrong input parameters');
		run;
	%end;
	

%EXIT:
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
			call symputx('RESULT_TEXT',"&SYSERRORTEXT.");
		run;
	%end;
%mend mpCreate_Release_Versions;
/**/
/*%let RELEASE_VERSION = 1;*/
/*%let RELEASE_TYPE1_ID = 1;*/
/*%let REQUEST_TYPE=ADD_RELEASE_VERSION;*/
/**/
/*%let TEXT_COMMENT = asd;*/
/*%let USER=asd;*/
/*%let DICT_VER_ID=3,2,1;*/
/**/
/*%let EVENT_NAME=DICT_VER_ID;*/
/**/
/*%mpCreate_Release_Versions;*/