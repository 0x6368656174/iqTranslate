<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=koi8-r">
   <meta name="Author" content="Pavel Puchkov">
   <title>IQ Mueller dictionary</title>
   <style type="text/css">
    a:link{color:#363636;} 
    a:visited {color:#363636;} 
    a:hover {color:#363636;} 
    a:active {color:#363636;}
   </style>

</head>

<body>

<?php
	$word = isset($_POST['word'])?$_POST['word']:"";
	$nbeg = isset($_POST['nbeg'])?($_POST['nbeg']?"CHECKED":""):"";
	$nexact = isset($_POST['nexact'])?($_POST['nexact']?"CHECKED":""):"";
	if (empty($_POST))
	{
	   $nbeg = "CHECKED";
	   $nexact = "CHECKED";
	}
?>

<form action="#" method="post">
<input type="text" name="word" size="40" value="<?php echo $word?>"/>
<input type="submit" value="�����"/> 
<br/>
<input type="checkbox" name="nbeg" <?php echo $nbeg?>/>������ ������
<input type="checkbox" name="nexact" <?php echo $nexact?>/>������ ����
<hr>
</form>

<?php

$dictionary = "./Mueller24.koi" ;

$wword = preg_replace ( "[^\*a-zA-Z�����ţ��������������������������]" 
		      , "" , $word ) ; // remove invalid char's
$wword = str_replace ( "*" , "[a-zA-Z�����ţ��������������������������]*" , $wword ) ;

$pref = $nexact ? "" : "([^a-z�����ţ��������������������������]|^)" ;
$suff = $nexact ? "" : "([^a-z�����ţ��������������������������]|$)" ;

if ( $nbeg ) { 
   $sopt = $nexact ?
		    "s/"
                    . $wword
                    . "/<span style=\"color:red; font-weight: bold;\">&<\/span>/g;" 
		   : 
		    "s/^\(".$wword."\)"
		    . "\([^a-zA-Z�����ţ��������������������������]\)"
		    . "/<span style=\"color:red; font-weight: bold;\">\\1<\/span>\\2/g;" 

	            ."s/"
		    . "\([^a-zA-Z�����ţ��������������������������]\)"
                    . "\(".$wword."\)"
		    . "\([^a-zA-Z�����ţ��������������������������]\)"
                    . "/\\1<span style=\"color:red; font-weight: bold;\">\\2<\/span>\\3/g;"

	            ."s/"
		    . "\([^a-zA-Z�����ţ��������������������������]\)"
                    . "\(".$wword."\)"
		    . "$"
                    . "/\\1<span style=\"color:red; font-weight: bold;\">\\2<\/span>/g;"
		  ;
   } else {
   $pref = "^" ; 
   $sopt = "" ;
   } ;

if ( $wword ) {
   echo "<dl>\n" ;
   PassThru( "grep -E -h -i \""
   .$pref.$wword.$suff
   ."\" ".$dictionary." | sed '"

   ."s/&/\&amp;/g;"
   ."s/</\&lt;/g;"
   ."s/>/\&gt;/g;"
   ."s/\"/\&quot;/g;"

   ."s/$/<br><br>/g;"

   ."s#\[[^[]*\]#<img align=top src=\"transcription.php?&\">#g;"

   .$sopt // ��������� ���� ����� ������

   ."s/ _([IVX])/ <br>\&nbsp;\&nbsp;&/g;"
   ."s/ [1-9]\. / <br>\&nbsp;\&nbsp;\&nbsp;\&nbsp;&/g;"
   ."s/_Ant:/<i>A������: <\/i>/g;"
   ."s/_Syn:/<i>C������: <\/i>/g;"
   ."s/_a\./<i>��� ��������������. <\/i>/g;"
   ."s/_adv\./<i>�������. <\/i>/g;"
   ."s/_artic\./<i>�������. <\/i>/g;"
   ."s/_attr\./<i>� �������� �����������. <\/i>/g;"
   ."s/_cj\./<i>����. <\/i>/g;"
   ."s/_comp\./<i>������������� �������. <\/i>/g;"
   ."s/_conj\./<i>������� �����������. <\/i>/g;"
   ."s/_demonstr\./<i>������������ �����������. <\/i>/g;"
   ."s/_emph\./<i>������������ (�����������). <\/i>/g;"
   ."s/_f\./<i>������� ���. <\/i>/g;"
   ."s/_imp\./<i>������������� ����������. <\/i>/g;"
   ."s/_impers\./<i>��������� �����. <\/i>/g;"
   ."s/_indef\./<i>�������������� �����������. <\/i>/g;"
   ."s/_inf\./<i>�������������� ����� �������. <\/i>/g;"
   ."s/_inter\./<i>(pronoun) �������������� (�����������). <\/i>/g;"
   ."s/_interj\./<i>����������. <\/i>/g;"
   ."s/_invar\./<i>������������. <\/i>/g;"
   ."s/_m\./<i>������� ���. <\/i>/g;"
   ."s/_mis\./<i>������������ ������������. <\/i>/g;"
   ."s/_n-card\./<i>�������������� ������������. <\/i>/g;"
   ."s/_n\./<i>���������������. <\/i>/g;"
   ."s/_n-ord.\./<i>���������� ������������. <\/i>/g;"
   ."s/_neg\./<i>�������������. <\/i>/g;"
   ."s/_obj\./<i>��������� �����. <\/i>/g;"
   ."s/_p-p\./<i>��������� ���������� �������. <\/i>/g;"
   ."s/_pres-p\./<i>��������� ���������� �������. <\/i>/g;"
   ."s/_p\./<i>�������. <\/i>/g;"
   ."s/_pass\./<i>������������� �����. <\/i>/g;"
   ."s/_pers\./<i>������ �����������. <\/i>/g;"
   ."s/_pf\./<i>����������� ���. <\/i>/g;"
   ."s/_pl\./<i>������������� �����. <\/i>/g;"
   ."s/_poss\./<i>�������������� �����������. <\/i>/g;"
   ."s/_predic\./<i>������������ � ������� ����� ����������. <\/i>/g;"
   ."s/_pref\./<i>���������. <\/i>/g;"
   ."s/_prep\./<i>�������. <\/i>/g;"
   ."s/_pres\./<i>��������� �����. <\/i>/g;"
   ."s/_pron\./<i>�����������. <\/i>/g;"
   ."s/_recipr\./<i>�������� �����������. <\/i>/g;"
   ."s/_refl\./<i>���������� �����������. <\/i>/g;"
   ."s/_rel\./<i>������������� �����������. <\/i>/g;"
   ."s/_sg\./<i>������������ �����. <\/i>/g;"
   ."s/_subj\./<i>������������ �����. <\/i>/g;"
   ."s/_suf\./<i>�������. <\/i>/g;"
   ."s/_sup\./<i>������������ �������. <\/i>/g;"
   ."s/_v\./<i>������. <\/i>/g;"
   ."s/_��\./<i>�������. <\/i>/g;"
   ."s/_�������\./<i>�������������. <\/i>/g;"
   ."s/_���\./<i>������������. <\/i>/g;"
   ."s/_��\./<i>������������, ������������� � ���. <\/i>/g;"
   ."s/_��\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>������������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_������\./<i>����������. <\/i>/g;"
   ."s/_�����\./<i>���������, �����������. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>�����������. <\/i>/g;"
   ."s/_����\./<i>�������������. <\/i>/g;"
   ."s/_����\./<i>�������� ����. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>�������� ���������. <\/i>/g;"
   ."s/_���\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>�������. <\/i>/g;"
   ."s/_����\./<i>������������� � ��������. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_����\./<i>������������� ����. <\/i>/g;"
   ."s/_���������\./<i>�����������������. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>������������. <\/i>/g;"
   ."s/_����\./<i>�������. <\/i>/g;"
   ."s/_�����\./<i>���������. <\/i>/g;"
   ."s/_����\./<i>�������������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>���������. <\/i>/g;"
   ."s/_�������\./<i>��������������. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_��\./<i>������. <\/i>/g;"
   ."s/_����\./<i>������ ����. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_����\./<i>���������. <\/i>/g;"
   ."s/_����\./<i>������; ����������; ������. <\/i>/g;"
   ."s/_����\./<i>�������. <\/i>/g;"
   ."s/_�����\./<i>������� ���������. <\/i>/g;"
   ."s/_����\./<i>�������; �������; �����. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>�������� ����. <\/i>/g;"
   ."s/_��-����\./<i>������-���������. <\/i>/g;"
   ."s/_��-���\./<i>���������������. <\/i>/g;"
   ."s/_��-���\./<i>������-�������. <\/i>/g;"
   ."s/_�-�\./<i>���������������. <\/i>/g;"
   ."s/_����\./<i>�����; ������. <\/i>/g;"
   ."s/_���\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_���\./<i>���������. <\/i>/g;"
   ."s/_���\./<i>. <\/i>/g;"
   ."s/_����\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>���������. <\/i>/g;"
   ."s/_���\./<i>��������� ����. <\/i>/g;"
   ."s/_���\./<i>�������. <\/i>/g;"
   ."s/_��\./<i>�����������. <\/i>/g;"
   ."s/_����\./<i>������������ ���������. <\/i>/g;"
   ."s/_����\./<i>��������� ������. <\/i>/g;"
   ."s/_���\./<i>��������������. <\/i>/g;"
   ."s/_���\./<i>���������. <\/i>/g;"
   ."s/_����\./<i>������� ���������. <\/i>/g;"
   ."s/_���\./<i>��������, ���������. <\/i>/g;"
   ."s/_����\./<i>�������������� �������. <\/i>/g;"
   ."s/_����\./<i>������������. <\/i>/g;"
   ."s/_���\./<i>����������; ��������. <\/i>/g;"
   ."s/_����\./<i>������������ ���������. <\/i>/g;"
   ."s/_���\./<i>��������� ����. <\/i>/g;"
   ."s/_���\./<i>�����������; ������ ���������. <\/i>/g;"
   ."s/_�����\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>�������������� � �����������������. <\/i>/g;"
   ."s/_���\./<i>������. <\/i>/g;"
   ."s/_�������\./<i>���������. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>��������, ����. �������. <\/i>/g;"
   ."s/_�����\./<i>�����������. <\/i>/g;"
   ."s/_������\./<i>������������. <\/i>/g;"
   ."s/_���\./<i>��������. <\/i>/g;"
   ."s/_���\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>���������. <\/i>/g;"
   ."s/_���\./<i>�������; ����������. <\/i>/g;"
   ."s/_���\./<i>������. <\/i>/g;"
   ."s/_���\./<i>����������, ��������. <\/i>/g;"
   ."s/_�������\./<i>���������������. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_�����\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_�����\./<i>������������. <\/i>/g;"
   ."s/_����\./<i>�����. <\/i>/g;"
   ."s/_�������\./<i>�������������. <\/i>/g;"
   ."s/_����\./<i>������������� ���������. <\/i>/g;"
   ."s/_�����\./<i>� ���������� ��������. <\/i>/g;"
   ."s/_����\./<i>����������. <\/i>/g;"
   ."s/_������\./<i>������������ ����. <\/i>/g;"
   ."s/_�����\./<i>��������. <\/i>/g;"
   ."s/_�����-��\./<i>������������ ��������. <\/i>/g;"
   ."s/_������\./<i>�������� ����. <\/i>/g;"
   ."s/_������\./<i>�������������. <\/i>/g;"
   ."s/_����\./<i>���������. <\/i>/g;"
   ."s/_����\./<i>����������� ���������. <\/i>/g;"
   ."s/_�����\./<i>�������������; �����������������. <\/i>/g;"
   ."s/_�����\./<i>���������������. <\/i>/g;"
   ."s/_�������\./<i>����������������. <\/i>/g;"
   ."s/_������\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>�����. <\/i>/g;"
   ."s/_����\./<i>�����������. <\/i>/g;"
   ."s/_�����\./<i>� ����������������, �������� ��������. <\/i>/g;"
   ."s/_����\./<i>������. <\/i>/g;"
   ."s/_���\./<i>��������� ��������������. <\/i>/g;"
   ."s/_���\./<i>�����������. <\/i>/g;"
   ."s/_�����\./<i>��������. <\/i>/g;"
   ."s/_���\./<i>�������. <\/i>/g;"
   ."s/_������\./<i>������������. <\/i>/g;"
   ."s/_�-�\./<i>�������� ���������. <\/i>/g;"
   ."s/_���\./<i>��������, �������������� �� ������ ������ � � ���������. <\/i>/g;"
   ."s/_�����\./<i>�������������. <\/i>/g;"
   ."s/_�����\./<i>������������� ��� ���������������. <\/i>/g;"
   ."s/_����\./<i>������������, ����������, ����������. <\/i>/g;"
   ."s/_����\./<i>�������������. <\/i>/g;"
   ."s/_���\./<i>�������������, �������. <\/i>/g;"
   ."s/_�����\./<i>�����������. <\/i>/g;"
   ."s/_����\./<i>������������. <\/i>/g;"
   ."s/_�����\./<i>����������. <\/i>/g;"
   ."s/_�����\./<i>�����. <\/i>/g;"
   ."s/_�����\./<i>�����. <\/i>/g;"
   ."s/_���\./<i>�������; ��������. <\/i>/g;"
   ."s/_���\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>�������; ����������. <\/i>/g;"
   ."s/_��\./<i>�����. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>��������. <\/i>/g;"
   ."s/_������\./<i>�������������� �����. <\/i>/g;"
   ."s/_����\./<i>�����������. <\/i>/g;"
   ."s/_�����\./<i>��������������, �������������. <\/i>/g;"
   ."s/_���\./<i>�������� �� ������������; �������. <\/i>/g;"
   ."s/_����\./<i>������������. <\/i>/g;"
   ."s/_���\./<i>������. <\/i>/g;"
   ."s/_������\./<i>����������. <\/i>/g;"
   ."s/_�����\./<i>���������. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_���\./<i>��������. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_��\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>�����. <\/i>/g;"
   ."s/_���\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>��������� ���������. <\/i>/g;"
   ."s/_����\./<i>������. <\/i>/g;"
   ."s/_����\./<i>��������. <\/i>/g;"
   ."s/_����\./<i>�����������. <\/i>/g;"
   ."s/_����\./<i>��������; ����������. <\/i>/g;"
   ."s/_���\./<i>���������������. <\/i>/g;"
   ."s/_��\./<i>���������; �������� ���������. <\/i>/g;"
   ."s/_��\./<i>�������������. <\/i>/g;"
   ."s/_���\./<i>�����������. <\/i>/g;"
   ."s/_���\./<i>����������. <\/i>/g;"
   ."s/_�-��\./<i>������������� � ����� �������. <\/i>/g;"
   ."s/_�-���\./<i>������������� � ����� ������. <\/i>/g;"
   ."s/_��\./<i>�����������, ��������. <\/i>/g;"
   ."s/_��\./<i>��������. <\/i>/g;"
   ."s/_//g;"
   ."s/= /<i>C������: <\/i> /g;"
   ."s/\( [1-9][0-9]*\)&gt; "
   . "/ <br>\&nbsp;\&nbsp;\&nbsp;\&nbsp;\&nbsp;\&nbsp;\\1) /g;"
   ."s/\( [�����ţ��������������������������]\)&gt; "
   ."/ <br>\&nbsp;\&nbsp;\&nbsp;\&nbsp;\&nbsp;\&nbsp;\&nbsp;\&nbsp;\\1) /g;"
   ."s#^\(.*\)  \(.*\)$#<dt>\\1<dd>\\2#g;"
   ."'" ) ;
   echo "</dl\n>" ;
   } else echo "����� ����� ���������.<br>"
     ." ������� �����-�������, ������� ����� � ������ ������ - �������"
     ." � �����������. ����� ������ ������ �������� ��� ��� ���������� ��� �"
     ." ��� ������� ����.<br>" 
     ." ������ ����� ������ '*' �������� ����� ������������������ ������,"
     ." �.�. '����*�' ���ģ� � '��������' � '�����������'."
     ;

echo "<hr>\n" ;
//phpinfo() ;
?>
<div style="color:#363636;">
V.K.Mueller's English-Russian Dictionary 24 Edition, Electronic Version by<br>
E.S.Cymbalyuk 1999-2000 and Pavel Puchkov 2013 under GNU GPL, ver. 1.0<br> 
PHP5/HTML5 interface designed by <a href="mailto:0x6368656174@gmail.com">Pavel Puchkov</a> 2013.<br>
PHP3 interface designed by <a href="mailto:V.Fyodorov@VAZ.ru">V.A.Fyodorov</a> 2000.<br>
</div>

</body>
