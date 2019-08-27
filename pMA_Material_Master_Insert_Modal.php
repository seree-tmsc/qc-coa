<div class="modal fade" id="insert_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Insert Data / Edit Data :</h4>
            </div>
            
            <div class="modal-body" id="detail"> 
                <form method='post' id='insert-form' enctype="multipart/form-data">
                    <input type="hidden" id="editmatCode" name="editmatCode">

                    <label>Material Code :</label>
                    <input type="text" id="matCode" name ="matCode" class='form-control'>                    
                    
                    <label>Material Name :</label>
                    <input type="text" id="matName" name ='matName' class='form-control' required>
                    
                    <label>Shelf Life:</label>
                    <input type="number" max="365" min="90" id="shelfLife" name = 'shelfLife' class='form-control' required>

                    <label>Pack size:</label>
                    <input type="number" max="2000" min="36" id="packSize" name = 'packSize' class='form-control' required>

                    <label>Shipment Condition:</label>
                    <input type="text" id="shipmentCond" name = 'shipmentCond' class='form-control' required>

                    <label>Storage Condition:</label>
                    <input type="text" id="storageCond" name = 'storageCond' class='form-control' required>

                    <label>Specification:</label>
                    <input type="text" id="spec" name = 'spec' class='form-control' required>

                    <label>Picture of drum-1:</label>
                    <input type="file" id="photoLoc1" name = "photoLoc1" class='form-control'>
                    <input type="text" id="txtphotoLoc1" name = "txtphotoLoc1" class='form-control' disabled>
                    <br>

                    <label>Picture of drum-2:</label>
                    <input type="file" id="photoLoc2" name = "photoLoc2" class='form-control'>
                    <input type="text" id="txtphotoLoc2" name = "txtphotoLoc2" class='form-control' disabled>
                    <br>
                    
                    <input type="submit" id='insert' class='btn btn-success'>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnClose" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>