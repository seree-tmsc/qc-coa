
<script type="text/javascript">
    $(document).ready(function(){
        //alert("Initial Jquery");

        $("#myTableMaterial").dataTable();

        $("#myTableMaterial").on("click", ".view_data", function(){
            var code = $(this).attr("mat_code");
            /*
            alert('class view_data');
            alert(code);
            */
            $.ajax({
                url: "pMA_Material_Master_View.php",
                method: "post",
                data: {id: code},
                success: function(data){
                    $('#detail').html(data);
                    $('#view_modal').modal('show');
                }
            });
        });

        $("#myTableMaterial").on("click", ".delete_data", function(){
            //alert('class delete_data');            
            var code = $(this).attr("mat_code");
            //alert(code);            

            var lConfirm = confirm("Do you want to delete this record?");
            //alert(lConfirm);
            if (lConfirm)
            {                
                $.ajax({
                    url: "pMA_Material_Master_Delete.php",
                    method: "post",
                    data: {id: code},
                    success: function(data){
                        location.reload();
                    }
                });  
            }
        });

        $('#myTableMaterial').on('click', '.edit_data', function(){
            /*            
            alert('class edit_data');
            */
            var code = $(this).attr("mat_code");
            //alert(code);

            $('#matCode').prop('disabled',true);
            $('#matCode').prop('required',false);
            /*
            $('#matName').prop('disabled',true);
            $('#matName').prop('required',false);
            */
            
            $.ajax({
                url: "pMA_Material_Master_Fetch.php",
                method: "post",
                data: {id: code},
                dataType: "json",
                success: function(data)
                {                                        
                    $('#editmatCode').val(data['Material Code']);
                    $('#matCode').val(data['Material Code']);                    
                    $('#matName').val(data['Material Name']);
                    $('#shelfLife').val(data['Shelf Life']);
                    $('#packSize').val(data['Packing Size']);
                    $('#shipmentCond').val(data['Shipment Condition']);
                    $('#storageCond').val(data['Storage Condition']);
                    $('#spec').val(data.Specification);                    
                    $('#txtphotoLoc1').val(data['Photo of drum1']);
                    $('#txtphotoLoc2').val(data['Photo of drum2']);
                    
                    $('#insert_modal').modal('show');
                    
                }
            });
        });

        $('.btn-insert').click(function(){
            //alert('class btn-insert');
            $('#matCode').prop('disabled',false);
            $('#matCode').prop('required',true);
            $('#matName').prop('disabled',false);
            $('#matName').prop('required',true);
        });
        
        $('.btnClose').click(function(){
            //alert('.btn-clode');
            $('#insert-form')[0].reset();
        });

        /* attach a submit handler to the form */        
        $("#insert-form").submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();
            //alert("Insert Mode");
            
            console.log( $( this ).serialize() );
            $.ajax({
                url: "pMA_Material_Master_Insert.php",
                method: "post",
                /*data: $('#insert-form').serialize(),*/
                data: new FormData( this ),
                processData: false,
                contentType: false,

                beforeSend:function(){
                    $('#insert').val('Insert...')
                },
                success: function(data){
                    if (data == '') {
                        $('#insert-form')[0].reset();
                        $('#insert_modal').modal('hide');
                        location.reload();
                    }
                    else
                    {
                        alert(data);
                        location.reload();
                    }
                }
            });   
        });
    });

</script>