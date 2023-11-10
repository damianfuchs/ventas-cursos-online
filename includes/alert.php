<html>
    <head>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
</html>

<?php

class alerta{

    protected $text;

    public function __construct($texto)
    {
        $this->text = $texto;
    }

    public function informar_error(){
        ?>

        <html>
            <script type = "text/javascript">
                swal('<?php echo $this->text?>','','error');
                </script>
        </html>
<?php
    }

    public function informar_approv(){
        ?>

        <html>
            <script type = "text/javascript">
                swal('<?php echo $this->text?>','','success');
                </script>
        </html>
<?php
    }

}




?>