<div class="modal fade" id="insert_modal" tabindex="-1" role="dialog">
    <!--<div class="modal-dialog modal-lg" role="document">-->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Quantity:</h4>
            </div>
            
            <div class="modal-body" id="detail"> 
                <form method='post' id='insert-form' enctype="multipart/form-data">
                    <input type="hidden" id="editmatCode" name="editmatCode">

                    <label>Invoice No :</label>
                    <input type="text" id="invNo" name ="invNo" class='form-control'>

                    <label>Material Code :</label>
                    <input type="text" id="matCode" name ="matCode" class='form-control'>
                    
                    <label>Material Name :</label>
                    <input type="text" id="matName" name ='matName' class='form-control'>
                    
                    <label>Lot No.</label>
                    <input type="text" id="lotNo" name ='lotNo' class='form-control'>

                    <label>Quantiry :</label>
                    <input type="number" id="qty" name = 'qty' class='form-control'>
                                        
                    <label> </label>
                    <input type="submit" id='insert' class='form-control btn btn-success'>
                </form>
            </div>

            <!--
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnClose" data-dismiss="modal">Close</button>
            </div>
            -->

        </div>
    </div>
</div>