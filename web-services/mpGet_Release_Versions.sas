%macro mpGet_Release_Versions;
%macro d; %mend d;
	
	/*Send XML output*/
	libname _WEBOUT xmlv2 xmlmeta=Data;

	/*Check input parameters*/
	%if "&REQUEST_TYPE." eq "ALL" 
		or ("&REQUEST_TYPE." eq "SINGLE" and %length(&RELEASE_VER_ID) ne 0)
		or ("&REQUEST_TYPE." eq "BY_RELEASE_TYPE1" and %length(&RELEASE_TYPE1_ID) ne 0)
		%then %do;

		data _null_;
			call symputx('RESULT_CODE','0');
		run;

		/*Determine where clause*/
		%let where_clause=;
		/*if single*/
		%if "&REQUEST_TYPE." eq "SINGLE" and %length(&RELEASE_VER_ID) ne 0 %then %do;
			%let where_clause=where rv.RELEASE_VER_ID=&RELEASE_VER_ID.;
		%end;
		/*if by release_type1*/
		%if "&REQUEST_TYPE." eq "BY_RELEASE_TYPE1" and %length(&RELEASE_TYPE1_ID) ne 0 %then %do;
			%let where_clause=where rv.RELEASE_TYPE1_ID=&RELEASE_TYPE1_ID.;
		%end;

		/*get release versions*/
		proc sql;
			connect to OLEDB as mydb 
				(init_string="Provider=SQLNCLI10;Persist Security Info=True;Initial Catalog=CIDB;Data Source=SASBAP;User ID=sasdemo;Password=Orion123;"); 

				create table work.output as
				select * from connection to mydb (
					select 
						rv.RELEASE_VER_ID,
						t1.RELEASE_TYPE1,
						rv.RELEASE_VERSION,
						rs.NAME_STATUS,
						rvh.ACTION_DTIME,
						rvh.ACTION_USER,
						rv.TEXT_COMMENT
					from RTData.MD_RELEASE_VER rv
					join RTData.MD_RELEASE_TYPE1 t1 on t1.RELEASE_TYPE1_ID=rv.RELEASE_TYPE1_ID
					join RTData.MD_RELEASE_STATUS rs on rs.CODE_STATUS=rv.CODE_STATUS
					left join (SELECT *, ROW_NUMBER() OVER(PARTITION BY RELEASE_VER_ID ORDER BY ACTION_DTIME DESC) as Corr
								FROM RTData.MD_RELEASE_VER_HIST) rvh on rvh.RELEASE_VER_ID = rv.RELEASE_VER_ID and rvh.Corr = 1
					&where_clause.
				);
			disconnect from mydb;
		quit;
		
		/*Send to XML*/
		data _webout.output;
			set work.output;
		run;
		%if not(&SYSCC lt 2 OR &SYSCC eq 4) %then %goto EXIT; 
	%end;
	%else %do;
		data _null_;
			call symputx('RESULT_CODE','-1');
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

%mend mpGet_Release_Versions;


/*%let REQUEST_TYPE=BY_RELEASE_TYPE1;*/
/*%let RELEASE_VER_ID=;*/
/*%let RELEASE_TYPE1_ID=1;*/
/**/
/*%mpGet_Release_Versions;*/
/**/
/*%put &=RESULT_CODE &=RESULT_TEXT;*/