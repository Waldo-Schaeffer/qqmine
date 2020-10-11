Attribute VB_Name = "Module1"
Public Function RndPass(Long1 As Byte) As String
    Randomize
    s = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
    For i = 1 To Long1
        x = x & Mid(s, Int(Rnd * Len(s) + 1), 1)
    Next
    RndPass = x
End Function

Public Function RndNum(Long1 As Byte) As String
    Randomize
    s = "0123456789"
    For i = 1 To Long1
        x = x & Mid(s, Int(Rnd * Len(s) + 1), 1)
    Next
    RndNum = x
End Function

Public Function RndChat(Long1 As Byte) As String
    Randomize
    s = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
    For i = 1 To Long1
        x = x & Mid(s, Int(Rnd * Len(s) + 1), 1)
    Next
    RndChat = x
End Function
