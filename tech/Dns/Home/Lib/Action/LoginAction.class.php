<?php
    class LoginAction extends Action{
        function login(){
            $this->display();
        }
        function IsUserExist($user){
            $m=M('user');
            $where['username']=$user;
            $num=$m->where($where)->count();
            if ($num==0){//���û�,return 0
                return 0;
            }else{
                return 1;//�û��Ѵ���
            }
        }
        function logout(){
            cookie(null); // ��յ�ǰ�趨ǰ׺������cookieֵ
            $this->display('login');
        }
        function check_login(){
            //get user pwd
            $user = $_POST['username'];
            $password = $_POST['password'];
            $ldaphost=C('LDAP_HOST');  
            $username = $user."@".C('LDAP_USER_SUFFIX');
            $logintime=date('Y-m-d H:i:s',time());
            //login
            if($_GET["action"]=="login"){
               $conn = ldap_connect($ldaphost);
                 if($conn){
                    //���ò���
                    ldap_set_option ( $conn, LDAP_OPT_PROTOCOL_VERSION, 3 );
                    ldap_set_option ( $conn, LDAP_OPT_REFERRALS, 0 ); // Binding to ldap server
                    echo "$username<br>$password";
                    $bd = ldap_bind($conn, $username, $password);
                    echo $bd;
                    if($bd and $user!='Username' and $user!='' and $password!=''){
                        //�������ʻ���user��
                        $m=M('user');
                        $data=array();
                        if($this->IsUserExist($user)==0){//new user
                            $data['username']=$user;
                            $data['role']='user';
                            $data['ustat']='off';
                            $data['logintime']=$logintime;
                            $m->data($data)->add();
                            
                        }else{
                            $data['logintime']=$logintime;
                            $m->where("username='$user'")->save($data);
                        }
                        
                    }else{
                        echo "<script>alert('�û������������')</script>";
                        $this->redirect('Login/login');
                    }
                    cookie('username',$user,C('COOKIE_TIMEOUT')); // ָ��cookie����ʱ��
                    cookie('isLogin',1,C('COOKIE_TIMEOUT'));
                    $this->redirect('Index/index');
                 }else{
                      echo "<script>alert('LDAP ����ʧ��!')</script>";
                 }
            }else if ($_GET["action"]=="logout"){
                
            }
        }
        
    }
?>
