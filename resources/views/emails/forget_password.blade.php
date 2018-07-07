亲爱的用户{{$user->name}}，您好！<br>
<br>
点击
<a href="{{url(config('app.url').route('user.auth.reset_password.reset', ['token'=>$token], false))}}" target="_blank">Client</a>
找回，有效期<strong>{{$expire}}</strong>分钟<br>
请勿将验证码透露给其他人。<br>
<br>
本邮件由系统自动发送，请勿直接回复！<br>
感谢您的访问，祝您使用愉快<br>
