%macro mpUpdate_Release_ver;
%macro d; %mend d;
	

	data _null_;
		call symputx('RESULT_CODE','0');
	run;

	proc sql;

	/*нахожу старые записи и удаляю их*/
	delete from RTData.MD_RELEASE_2_DICT where RELEASE_VER_ID = &RELEASE_VER_ID.;
	/*добавляю (обновляю) данные 	*/
		%let word_cnt=%sysfunc(countw("&DICT_VER_ID.",%str(,)));
				%DO I = 1 %TO &word_cnt.;
					insert into RTData.MD_RELEASE_2_DICT (RELEASE_VER_ID,DICT_VER_ID,USER_INSERTED) 
					VALUES (&RELEASE_VER_ID., %scan(%bquote(&DICT_VER_ID.), &i, %str(,)), "&USER.");
				%END;
			
	INSERT INTO RTData.MD_RELEASE_VER_HIST(RELEASE_VER_ID,ACTION_USER, ACTION_TYPE, TEXT_COMMENT) VALUES (&RELEASE_VER_ID.,"&USER.","&CODE_NAME.","&TEXT_COMMENT.");
	
	quit;
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 
	

%EXIT:
	%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
			call symputx('RESULT_TEXT',"&SYSERRORTEXT.");
		run;
	%end;
%mend mpUpdate_Release_ver;

/*%let RELEASE_VER_ID = 8013;*/
/**/
/**/
/*%let CODE_NAME =In development;*/
/*%let TEXT_COMMENT = test;*/
/*%let USER=test;*/
/*%let DICT_VER_ID=1,2;*/
/**/
/*%let EVENT_NAME=DICT_VER_ID;*/
/**/
/*%mpUpdate_Release_ver;*/