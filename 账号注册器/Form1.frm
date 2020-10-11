VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "账号注册器"
   ClientHeight    =   2985
   ClientLeft      =   120
   ClientTop       =   450
   ClientWidth     =   20595
   LinkTopic       =   "Form1"
   ScaleHeight     =   2985
   ScaleWidth      =   20595
   StartUpPosition =   1  '所有者中心
   Begin VB.CheckBox Check1 
      Caption         =   "禁用账号"
      Height          =   375
      Left            =   3000
      TabIndex        =   8
      Top             =   1320
      Width           =   2775
   End
   Begin VB.CommandButton Command2 
      Caption         =   "重置账号"
      Height          =   495
      Left            =   19440
      TabIndex        =   12
      Top             =   120
      Width           =   975
   End
   Begin VB.TextBox Phone6Tx 
      Height          =   375
      Left            =   18000
      Locked          =   -1  'True
      TabIndex        =   10
      Top             =   720
      Width           =   1215
   End
   Begin VB.CommandButton Command3 
      Caption         =   "生成验证码"
      Height          =   495
      Left            =   18000
      TabIndex        =   9
      Top             =   120
      Width           =   1215
   End
   Begin VB.TextBox ChanAllTx 
      Height          =   375
      Left            =   13440
      TabIndex        =   6
      Text            =   "0"
      Top             =   720
      Width           =   1935
   End
   Begin VB.TextBox NoteTx 
      Height          =   375
      Left            =   5520
      TabIndex        =   2
      Text            =   "QQ"
      Top             =   720
      Width           =   2295
   End
   Begin VB.TextBox NickTx 
      Height          =   375
      Left            =   2880
      TabIndex        =   1
      Top             =   720
      Width           =   2295
   End
   Begin VB.TextBox PhoneTx 
      Height          =   375
      Left            =   240
      TabIndex        =   0
      Top             =   720
      Width           =   2295
   End
   Begin VB.TextBox UseDayTx 
      Height          =   375
      Left            =   8160
      TabIndex        =   3
      Text            =   "31"
      Top             =   720
      Width           =   1335
   End
   Begin VB.TextBox EndDayTx 
      Height          =   375
      Left            =   15720
      TabIndex        =   7
      Text            =   "2020-12-31 23:59:59"
      Top             =   720
      Width           =   2175
   End
   Begin VB.TextBox ChanTx 
      Height          =   375
      Left            =   11520
      TabIndex        =   5
      Text            =   "10"
      Top             =   720
      Width           =   1575
   End
   Begin VB.TextBox UserTx 
      Height          =   375
      Left            =   9840
      TabIndex        =   4
      Text            =   "S0000080"
      Top             =   720
      Width           =   1335
   End
   Begin VB.TextBox UsPsTx 
      Height          =   375
      Left            =   15720
      Locked          =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   14
      Text            =   $"Form1.frx":0000
      Top             =   1200
      Width           =   3495
   End
   Begin VB.TextBox SqlTe 
      Height          =   975
      Left            =   240
      Locked          =   -1  'True
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   13
      Text            =   "Form1.frx":0024
      Top             =   1800
      Width           =   20295
   End
   Begin VB.CommandButton Command1 
      Caption         =   "生成账号"
      Default         =   -1  'True
      Height          =   495
      Left            =   19440
      TabIndex        =   11
      Top             =   1080
      Width           =   975
   End
   Begin VB.Label Label10 
      Caption         =   "请输入高级权限等级："
      Height          =   255
      Left            =   13440
      TabIndex        =   24
      Top             =   240
      Width           =   1935
   End
   Begin VB.Label Label9 
      Caption         =   "请输入备注"
      Height          =   255
      Left            =   5520
      TabIndex        =   23
      Top             =   240
      Width           =   2295
   End
   Begin VB.Label Label8 
      Caption         =   "请输入昵称"
      Height          =   255
      Left            =   2880
      TabIndex        =   22
      Top             =   240
      Width           =   2295
   End
   Begin VB.Label Label7 
      Caption         =   "请输入手机号"
      Height          =   255
      Left            =   240
      TabIndex        =   21
      Top             =   240
      Width           =   2295
   End
   Begin VB.Label Label6 
      Caption         =   "请输入激活天数"
      Height          =   255
      Left            =   8160
      TabIndex        =   20
      Top             =   240
      Width           =   1335
   End
   Begin VB.Label Label5 
      Caption         =   $"Form1.frx":0036
      Height          =   255
      Left            =   240
      TabIndex        =   19
      Top             =   1320
      Width           =   3255
   End
   Begin VB.Label Label4 
      Caption         =   $"Form1.frx":004B
      Height          =   255
      Left            =   12120
      TabIndex        =   18
      Top             =   1320
      Width           =   3255
   End
   Begin VB.Label Label3 
      Caption         =   "请输入激活有效期："
      Height          =   255
      Left            =   15720
      TabIndex        =   17
      Top             =   240
      Width           =   1695
   End
   Begin VB.Label Label2 
      Caption         =   "请输入权限等级"
      Height          =   255
      Left            =   11520
      TabIndex        =   16
      Top             =   240
      Width           =   1455
   End
   Begin VB.Label Label1 
      Caption         =   "请输入用户名"
      Height          =   255
      Left            =   9840
      TabIndex        =   15
      Top             =   240
      Width           =   1335
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Option Explicit
Private Sql As String, UP As String, RemPassword As String, Chan As Long, ChanAll As Long, PhoneNum As String, NickName As String


Private Sub Command1_Click()
    'insert into user(username,password，end_time,use_day,phonenum,nickname,note,Channel,`Channel-all`,ban_id) values('test','test','2020-07-31 23:59:59',14,'38380438','test','this is a test acount',2047,2047,0);
    '生成随机密码
    RemPassword = RndNum(7) & RndPass(1)
    '计算权限
    Chan = 2 ^ CLng(Val(ChanTx.Text)) - 1
    ChanAll = 2 ^ CLng(Val(ChanAllTx.Text)) - 1
    '防止空字符串，直接赋值Null
    If PhoneTx.Text <> "" Then PhoneNum = "'" & PhoneTx.Text & "'" Else PhoneNum = "Null"
    If NickTx.Text <> "" Then NickName = "'" & NickTx.Text & "'" Else NickName = "''"
    '初始化SQL语句
    Sql = "insert into `user`(`username`,`password`,`end_time`,`use_day`,`phonenum`,`nickname`,`note`,`Channel`,`Channel-all`,`ban_id`) values('"
    '给SQL赋值
    Sql = Sql & UserTx.Text & "','" & RemPassword & "','" & EndDayTx.Text & "'," & UseDayTx.Text & "," & PhoneNum & "," & NickName & ",'" & NoteTx.Text & "'," & Chan & "," & ChanAll & "," & Check1.Value & ");"
    '查询输出结果
    Sql = Sql & vbCrLf & "select * from user where username='" & UserTx.Text & "';"
    '输出SQL的用户名密码
    UP = "用户名： " & UserTx.Text & "，密码：" & RemPassword
    '给文本框赋值
    SqlTe.Text = Sql
    UsPsTx.Text = UP
End Sub

Private Sub Command2_Click()
    'insert into user(username,password，end_time,use_day,phonenum,nickname,note,Channel,`Channel-all`,ban_id) values('test','test','2020-07-31 23:59:59',14,'38380438','test','this is a test acount',2047,2047,0);
    'UPDATE `user` SET `user_id`=[value-1],`create_time`=[value-2],`update_time`=[value-3],`end_time`=[value-4],`use_day`=[value-5],`used_time`=[value-6],`username`=[value-7],`password`=[value-8],`phonenum`=[value-9],`nickname`=[value-10],`note`=[value-11],`Channel`=[value-12],`Channel-all`=[value-13],`ban_id`=[value-14] WHERE 1
    '如果是Ban账号就直接Ban
    If Check1.Value Then
        SqlTe.Text = "UPDATE `user` SET `ban_id=1 where `username`='" & UserTx.Text & "';" & vbCrLf & "select * from user where username='" & UserTx.Text & "';"
        Exit Sub
    End If
    '生成随机密码
    RemPassword = RndNum(7) & RndPass(1)
    '计算权限
    Chan = 2 ^ CLng(Val(ChanTx.Text)) - 1
    ChanAll = 2 ^ CLng(Val(ChanAllTx.Text)) - 1
    '防止空字符串，直接赋值Null
    If PhoneTx.Text <> "" Then PhoneNum = "'" & PhoneTx.Text & "'" Else PhoneNum = "Null"
    If NickTx.Text <> "" Then NickName = "'" & NickTx.Text & "'" Else NickName = "''"
    '初始化SQL语句,给SQL赋值
    Sql = "UPDATE `user` SET `password`='" & RemPassword & "',`end_time`='" & EndDayTx.Text & "',`use_day`=" & UseDayTx.Text & ",`phonenum`=" & PhoneNum & ",`nickname`=" & NickName & ",`note`='" & NoteTx.Text & "',`Channel`=" & Chan & ",`Channel-all`=" & ChanAll & ",`used_time` = Null,`ban_id`=0 where `username`='" & UserTx.Text & "';"
    '查询输出结果
    Sql = Sql & vbCrLf & "select * from user where username='" & UserTx.Text & "';"
    '输出SQL的用户名密码
    UP = "用户名： " & UserTx.Text & "，密码：" & RemPassword
    '给文本框赋值
    SqlTe.Text = Sql
    UsPsTx.Text = UP
End Sub

Private Sub Command3_Click()
    Phone6Tx.Text = RndNum(6)
End Sub

Private Sub Form_Load()
    Command3_Click
    NoteTx.SelStart = 20
    UseDayTx.SelStart = 20
    UserTx.SelStart = 20
    ChanTx.SelStart = 20
    ChanAllTx.SelStart = 20
    EndDayTx.SelStart = 30
    Phone6Tx.SelStart = 7
    SqlTe.Text = "这里输出SQL语句"
End Sub
