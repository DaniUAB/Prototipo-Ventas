$ep = 'http://localhost/MVC%20ventas/index.php'
$mysql = 'C:\xampp\mysql\bin\mysql.exe'
$nail = & $mysql -u root -N -e "USE ventas_db; SELECT email,password FROM usuarios WHERE rol<>'admin' LIMIT 1;"
write-host "cred vendedor: $nail"
$rows = @(& $mysql -u root -N -e "USE ventas_db; SELECT email,password FROM usuarios;")
foreach ($row in $rows) { write-host "cred: $row" }
$idcli = (& $mysql -u root -N -e "USE ventas_db; SELECT id FROM clientes LIMIT 1").Trim()
write-host "idcli=$idcli"

$s = New-Object Microsoft.PowerShell.Commands.WebRequestSession
Invoke-WebRequest -Uri "${ep}?c=auth&a=autenticar" -Method POST -Body @{ email='vendedor@ventas.com'; password='vendedor123' } -WebSession $s -UseBasicParsing | Out-Null

foreach ($m in @(@('cliente','cliente'),@('producto','producto'),@('categoria','categoria'),@('venta','venta'))) {
  $default=''
  if ($m[0] -eq 'categoria') { $default='default/' } elseif ($m[0] -eq 'venta') { $default='../' }
  $r = Invoke-WebRequest -Uri "${ep}?c=$($m[0])&a=index" -WebSession $s -UseBasicParsing
  $nuevos = ([regex]::Matches($r.Content, '>Nuevo|>Nueva')).Count
  $ver    = ([regex]::Matches($r.Content, '>Ver<')).Count
  $edits  = ([regex]::Matches($r.Content, '>Editar<')).Count
  $dels   = ([regex]::Matches($r.Content, '>Eliminar<|>Anular<')).Count
  $deneg  = $r.Content -match 'Acceso denegado|403'
  write-host ("  {0} | 200 OK | Nuevo:{1} Ver:{2} Editar:{3} Eliminar/Anular:{4} | 403:{5}" -f $m[0],$nuevos,$ver,$edits,$dels,$deneg)
}
