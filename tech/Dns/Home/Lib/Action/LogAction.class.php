<?php
class LogAction extends Action{
    function log(){
        $index=A('Index');
        $index->IsLogin();
        $m=M('log');
        import('ORG.Util.Page');// �����ҳ��
        $count      = $m->count();// ��ѯ����Ҫ����ܼ�¼��
        $Page       = new Page($count,100);// ʵ������ҳ�� �����ܼ�¼����ÿҳ��ʾ�ļ�¼��
        $show       = $Page->show();// ��ҳ��ʾ���
        // ���з�ҳ���ݲ�ѯ ע��limit�����Ĳ���Ҫʹ��Page�������
        $data = $m->order('logtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('sinfo','');
        $this->assign('data',$data);// ��ֵ���ݼ�
        $this->assign('page',$show);// ��ֵ��ҳ���
        $this->display();
    }
    
    //search 
    function search(){
        $sinfo=iconv( "UTF-8","GBK" , $_GET["sinfo"]);
        $where=array();
        $sinfo2=preg_replace('/_/','\\_',$sinfo);//mysql��"_"Ϊ�����ַ�����Ҫת��

        if($sinfo){
            $where["username|content|logtime"]=array('like',"%$sinfo2%");
        }
        $m=M('log');
        import('ORG.Util.Page'); //�����ҳ��
        $count = $m->where($where)->count(); //��ѯ����Ҫ����ܼ�¼��
        $Page = new Page($count,100); //ʵ������ҳ�� �����ܼ�¼����ÿҳ��ʾ�ļ�¼��
        $show = $Page->show(); //��ҳ��ʾ���
         //���з�ҳ���ݲ�ѯ ע��limit�����Ĳ���Ҫʹ��Page�������
        $data = $m->where($where)->order('logtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('sinfo',$sinfo);
        $this->assign('data',$data); //��ֵ���ݼ�
        $this->assign('page',$show);// ��ֵ��ҳ���
        $this->display('log');                  
    }
    
}

?>