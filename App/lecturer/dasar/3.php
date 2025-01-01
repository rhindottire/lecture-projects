<HTML>
<HEAD>
  <TITLE>SYNTAX :PHP</TITLE>
</HEAD>
<BODY>
  <?php 
    echo "Menggunakan echo<br>";
    echo "================<br>";
    $data="devie <br>";
    echo "$data";
    echo "D3 Manajemen Informatika <br>";
    echo $data."Dosen Unijoyo";
  ?>
  <?php 
    print ("<br><br> Menggunakan print <br>");
    print ("================<br>");
    $data="devie <br>";
    print "$data";
    print "D3 Manajemen Informatika <br>";
    print $data."Dosen Unijoyo";
  ?>
  <?php 
    printf ("<br><br> Menggunakan printf <br>");
    printf ("================<br>");
    $data="devie";
    printf("%s",$data);
    printf("%s Dosen Unijoyo",$data);
  ?>
</BODY>
</HTML>