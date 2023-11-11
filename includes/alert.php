<html>
    <head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
</html>

<?php

class alerta{

    protected $title;
    protected $desc;

    public function __construct($titulo, $descripcion)
    {
        $this->title = $titulo;
        $this->desc = $descripcion;
    }

    public function informar_error(){
        echo '<script type="text/javascript">
            $(document).ready(function(){
                Swal.fire({
                    title: \''.$this->title.'\',
                    text: \''.$this->desc.'\',
                    icon: "error"
                });
            });
        </script>';
    }

    public function informar_approv(){

        echo '<script type="text/javascript">
            $(document).ready(function(){
                Swal.fire({
                    title: \''.$this->title.'\',
                    text: \''.$this->desc.'\',
                    icon: "success"
                });
            });
        </script>';
    }

}
?>