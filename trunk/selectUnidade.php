<div id="selectUnidade">
    <p>
        <label>Unidade: <select name="selUnidade" required>
                <option value="0">--</option>
                <?php
                //Consulta de unidades do sistema
                $selectUnidades = $bdMi->sql("SELECT * FROM unidade");
                if (mysql_num_rows($selectUnidades) > 0) {
                    $c = 1;
                    while ($resultadoUnidades = mysql_fetch_array($selectUnidades)) {
                        echo "<option value=$c> $resultadoUnidades[1]</option>";
                        $c++;
                    }
                }
                ?>
            </select>
        </label>
    </p>
</div>