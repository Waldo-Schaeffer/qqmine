VERSION 5.00
Begin VB.Form Form1 
   Caption         =   "批量账号生成器"
   ClientHeight    =   6690
   ClientLeft      =   120
   ClientTop       =   450
   ClientWidth     =   20475
   LinkTopic       =   "Form1"
   ScaleHeight     =   6690
   ScaleWidth      =   20475
   StartUpPosition =   3  '窗口缺省
   Begin VB.TextBox Text6 
      Height          =   270
      Left            =   16560
      TabIndex        =   15
      Text            =   "14"
      Top             =   6240
      Width           =   1335
   End
   Begin VB.TextBox Text5 
      Height          =   270
      Left            =   13200
      TabIndex        =   11
      Text            =   "2020-07-31 23：59：59"
      Top             =   6240
      Width           =   2175
   End
   Begin VB.TextBox Text4 
      Height          =   270
      Left            =   9720
      TabIndex        =   9
      Text            =   "10"
      Top             =   6240
      Width           =   1335
   End
   Begin VB.TextBox Text3 
      Height          =   270
      Left            =   6720
      TabIndex        =   6
      Text            =   "1"
      Top             =   6240
      Width           =   1335
   End
   Begin VB.OptionButton Option3 
      Caption         =   "生成SVIP账号"
      Height          =   375
      Left            =   3600
      TabIndex        =   5
      Top             =   6240
      Width           =   1455
   End
   Begin VB.OptionButton Option2 
      Caption         =   "生成VIP账号"
      Height          =   375
      Left            =   1920
      TabIndex        =   4
      Top             =   6240
      Width           =   1455
   End
   Begin VB.OptionButton Option1 
      Caption         =   "生成普通账号"
      Height          =   375
      Left            =   240
      TabIndex        =   3
      Top             =   6240
      Value           =   -1  'True
      Width           =   1455
   End
   Begin VB.TextBox Text2 
      Height          =   5535
      Left            =   16800
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   2
      Text            =   "Form1.frx":0000
      Top             =   480
      Width           =   3495
   End
   Begin VB.TextBox Text1 
      Height          =   5535
      Left            =   120
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   1
      Text            =   "Form1.frx":0021
      Top             =   480
      Width           =   16455
   End
   Begin VB.CommandButton Command1 
      Caption         =   "生成"
      Height          =   495
      Left            =   18120
      TabIndex        =   0
      Top             =   6120
      Width           =   1215
   End
   Begin VB.Label Label6 
      Caption         =   "激活天数："
      Height          =   255
      Left            =   15480
      TabIndex        =   14
      Top             =   6240
      Width           =   975
   End
   Begin VB.Label Label5 
      Caption         =   $"Form1.frx":0033
      Height          =   255
      Left            =   120
      TabIndex        =   13
      Top             =   120
      Width           =   3255
   End
   Begin VB.Label Label4 
      Caption         =   $"Form1.frx":0048
      Height          =   255
      Left            =   16800
      TabIndex        =   12
      Top             =   120
      Width           =   3255
   End
   Begin VB.Label Label3 
      Caption         =   "请输入激活有效期："
      Height          =   255
      Left            =   11280
      TabIndex        =   10
      Top             =   6240
      Width           =   1695
   End
   Begin VB.Label Label2 
      Caption         =   "请输入截止ID："
      Height          =   255
      Left            =   8160
      TabIndex        =   8
      Top             =   6240
      Width           =   1335
   End
   Begin VB.Label Label1 
      Caption         =   "请输入起始ID："
      Height          =   255
      Left            =   5280
      TabIndex        =   7
      Top             =   6240
      Width           =   1335
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub Command1_Click()
    Dim A As String, i As Long, Lname As String, B As String, Channel As Long, Used_time As Date, Use_day As Long
    Used_time = Text5.Text: Use_day = CLng(Val(Text6.Text))
    If Option1.Value Then
        Lname = "U"
        Channel = 8 - 1
    ElseIf Option2.Value Then
        Lname = "V"
        Channel = 256 - 1
    ElseIf Option3.Value Then
        Lname = "S"
        Channel = 1024 - 1
    End If
    
    A = ""
    B = ""
    For i = CLng(Val(Text3.Text)) To CLng(Val(Text4.Text))
        'insert into user(username,password，end_time,use_day,phonenum,nickname,note,Channel,`Channel-all`,ban_id) values('test','test','2020-07-31 23:59:59',14,'38380438','test','this is a test acount',2047,2047,0);
        A = A & "insert into user(username,password,end_time,use_day,phonenum,nickname,note,Channel,`Channel-all`,ban_id) values('"
        A = A & Lname & Format(i, "0000000") & "','"
        B = B & "用户名： " & Lname & Format(i, "0000000") & "，密码："
        rempassword = RndNum(7) & RndPass(1)
        A = A & rempassword & "','" & Used_time & "'," & Use_day & ",Null,'','',"
        B = B & rempassword & vbCrLf
        A = A & Channel & "" & ",0,0);" & vbCrLf
    Next
    Text1.Text = A
    Text2.Text = B
End Sub

