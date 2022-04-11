<?php
include '../lib/conexion.php';
include 'pagination.php'; //include pagination file
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
$tipomov = (isset($_REQUEST['tipomov'])&& $_REQUEST['tipomov'] !=NULL)?$_REQUEST['tipomov']:'';
  if (isset($_GET['id'])){
    $codigo=intval($_GET['id']);
    $query=mysql_query("select * from facturas where codigo='".$codigo."'");
    $count=mysql_num_rows($query);
    if ($count==0){
      if ($delete1=mysql_query("DELETE FROM catalogo WHERE codigo='".$codigo."'")){
      ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Aviso!</strong> Datos eliminados exitosamente.
      </div>
      <?php 
    }else {
      ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
      </div>
      <?php
      
    }
      
    } else {
      ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto. 
      </div>
      <?php
    }
    
    
    
  }
  if($action == 'ajax'){
    $nummay=mysql_fetch_array(mysql_query("select LAST_INSERT_ID(nromovimiento) as last from movimiento WHERE tipomovimiento='cliente' order by nromovimiento desc limit 0,1 "));
    $num=$nummay['last'];
        $nom=mysql_fetch_array(mysql_query("SELECT pagina FROM config WHERE codcof='1'"));
        $numpag=$nom['pagina'];
        $q = mysql_real_escape_string(strip_tags($_REQUEST['q'], ENT_QUOTES));
        $aColumns = array('nromovimiento');//Columnas de busqueda
        $sTable = "movimiento";
        $sWhere = "";
        $sWhere.=" WHERE movimiento.tipomovimiento='$tipomov'";//determina si es cliente o proveedor
        if ( $_GET['q'] != "" ){
          $sWhere = "WHERE (";
          for ( $i=0 ; $i<count($aColumns) ; $i++ ){
            $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
          }
          $sWhere = substr_replace( $sWhere, "", -3 );
          $sWhere .= ')';
        }
        $sWhere.=" order by nromovimiento asc";
    //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = $numpag; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
        $count_query   = mysql_query("SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= $num;
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = './index.php';
    //main query to fetch the data

        if ($numrows>0){
          ?>
          <div class="table-responsive">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr bgcolor="#5194c7">
                  <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
                <td class="tabhead"><img src="img/blank.gif" alt="" width="140" height="2"><br><b>#</b></td>
          <td class="tabhead"><img src="img/blank.gif" alt="" width="150" height="2"><br><b>Fecha</b></td>
          <td class="tabhead"><img src="img/blank.gif" alt="" width="150" height="2"><br><b>Cliente</b></td>
          <td class="tabhead"><img src="img/blank.gif" alt="" width="150" height="2"><br><b>NIT</b></td>
          <td class="tabhead"><img src="img/blank.gif" alt="" width="150" height="2"><br><b>Total</b></td>
          <td class="tabhead"><img src="img/blank.gif" alt="" width="150" height="2"><br><b>Vendedor</b></td>
                <td class="tabhead"><img src="img/blank.gif" alt="" width="100" height="2"><br><b>Acciones</b></td>
                  <td><img src="img/blank.gif" alt="" width="10" height="25"></td>
                </tr>

              <?php
              $i = 0;
            for ($j=1; $j <= $num; $j++) {
              $query = mysql_query("SELECT * FROM movimiento WHERE tipomovimiento='$tipomov' AND nromovimiento='$j' order by nromovimiento desc LIMIT $offset,$per_page");
              $precio=0;
              
                while ($row=mysql_fetch_array($query)){
                  $nromovimiento=$row['nromovimiento'];
                  $fecha=$row['fecha'];
                  $total=$row['totalConDescuento'];
                  $entrada=$row['entrada'];
                  $salida=$row['salida'];
                  $nomaux=$row['nomaux'];
                  $nit=$row['nit'];
                  $coduser=$row['coduser'];
                  $tip=$row['tipomovimiento'];

                  $precio=$precio+$total;
                  $precio_desc=number_format($precio,2);
              
                }
              if ($tipomov==$tip) {
                  if ($i > 0) {
                    echo "<tr valign='bottom'>";
                    echo "<td bgcolor='#ffffff' height='1' style='background-image:url(img/strichel.gif)' colspan='7'></td>";
                    echo "</tr>";
                  }
            
          
                ?>

                <tr valign='middle'>
                  <td class='tabval'><img src='img/blank.gif' alt='' width='10' height='20'></td>
                  <td class='tabval'><?php echo $nromovimiento; ?>&nbsp;</td>
                  <td class='tabval'><?php echo $fecha; ?>&nbsp;</td>
                  <td class='tabval'><?php echo $nomaux; ?>&nbsp;</td>
                  <td class='tabval'><?php echo $nit; ?>&nbsp;</td>
                  <td class='tabval'><?php echo $precio_desc;?>&nbsp;</td>
                  <td class='tabval'><?php echo $coduser; ?>&nbsp;</td>

                <td>
            <a href="modificarfactura.php?nromovimiento=<?php echo $nromovimiento;?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a> 
            <a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $nromovimiento;?>');"><i class="glyphicon glyphicon-download"></i></a> 
            <a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $nromovimiento; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
          </td>
            
          </tr>
              
                <?php
                $i++;
               }
             }
              echo "<tr valign='bottom'>";
              echo "<td bgcolor='#5194c7' colspan='7'><img src='img/blank.gif' alt='' width='1' height='15'></td>";
              echo "</tr>";
          ?>
              <tr>
                  <td colspan=7><span class="pull-left">
                  <?php
                    echo paginate($reload, $page, $total_pages, $adjacents);
                  ?>
                  </span></td>
              </tr>
            </table>
          </div>
          <?php
      }
  }
?>