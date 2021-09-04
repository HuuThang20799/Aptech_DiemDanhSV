Create table APTECH_GIANGVIEN(
	GV_ID varchar(30) primary key,
	GV_TEN varchar(30),
	GV_GIOITINH bit,
	GV_EMAIL nvarchar(50)
);

CREATE TABLE APTECH_ACCOUNT_TEACHER(
	username varchar(50) primary key,
	password varchar(80) NOT NULL,
	GV_ID varchar(30)  NOT NULL FOREIGN KEY REFERENCES APTECH_GIANGVIEN(GV_ID),
	status bit
);

create table APTECH_DIEMDANHSV(
	LOP_ID varchar(20) NOT NULL FOREIGN KEY REFERENCES APTECH_DMLOP(LOP_ID),
	SV_MSSV nvarchar(30) NOT NULL FOREIGN KEY REFERENCES APTECH_DMSINHVIEN(SV_MSSV),
	SV_TEN nvarchar(50),
	LH_UserName varchar(30) NOT NULL FOREIGN KEY REFERENCES APTECH_GIANGVIEN(GV_ID),
	KHOA_ID nvarchar(30) NOT NULL FOREIGN KEY REFERENCES APTECH_DMKHOAHOC(KHOA_ID),
	MH_ID nvarchar(30) NOT NULL FOREIGN KEY REFERENCES APTECH_DMMONHOC(MH_ID),
	MH_TEN nvarchar(50) ,
	T1 int,
	T2 int,
	L1 int,
	T3 int,
	L2 int,
	T4 int,
	L3 int,
	T5 int,
	L4 int,
	T6 int,
	L5 int,
	T7 int,
	L6 int,
	T8 int,
	L7 int,
	T9 int,
	L8 int,
	T10 int,
	L9 int,
	T11 int,
	L10 int,
	Remarks nvarchar(50),
	FacultyName nvarchar(30),
	TotalPresent int,
	SessionCode NVARCHAR(70),
	Date nvarchar(30),
	StartDate nvarchar(30),
	FrameTime nvarchar(30),
	primary key (LOP_ID, SV_MSSV)
);

