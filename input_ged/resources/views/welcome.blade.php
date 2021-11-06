<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Document</title>
</head>

    

<body>
    <div class="container">
    <form class="col-lg-8">
    <table class="table" id="tableau_produit">
        <thead>
            <tr>
                <th style="width:40%;">Cote</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $numero_tableau = 0;
            for ($x=1; $x < 2; $x++) {?>
            <tr id="row<?php echo $x; ?>" class="<?php echo $numero_tableau; ?>">
                
                <td style="margin-left:20px;">
                <div class="form-group">
                    <input type="text" name="latitude[]" id="latitude<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" />
                </div>
                </td>
                <td style="margin-left:20px;">
                <div class="form-group">
                    <input type="text" name="longitude[]" id="longitude<?php echo $x; ?>" autocomplete="off" class="form-control" min="1" />
                </div>
                </td>
            </tr>
            <?php
            $numero_tableau++;
            }
            ?>
        </tbody>
    </table>
  
  <button type="button" id="addRowBtn" onclick="addRow()" class="btn btn-primary">Ajouter</button>
  <button type="button" id="saveRowBtn" class="btn btn-success">Enregistrer</button>
</form>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    // Ajouter une ligne
function addRow() {
	var tableLength = $("#tableau_produit tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {
		tableRow = $("#tableau_produit tbody tr:last").attr('id');
		arrayNumber = $("#tableau_produit tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
    

        var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
            '<td>'+
                '<input type="text" name="latitude[]" id="latitude'+count+'" autocomplete="off" class="form-control" />'+
            '</td>'+
            '<td>'+
                '<input type="text" name="longitude[]" id="longitude'+count+'" autocomplete="off" class="form-control" />'+
            '</td>'+
            
        '</tr>';
        if(tableLength > 0) {
            $("#tableau_produit tbody tr:last").after(tr);
        } else {
            $("#tableau_produit tbody").append(tr);
        }
}

$('#saveRowBtn').on('click', function(){
    
    var latitude = $('input[name="latitude[]"]').map(function(){
      return this.value;
    }).get();

    var longitude = $('input[name="longitude[]"]').map(function(){
      return this.value;
    }).get();

    $.ajax({
        url: '{{ url('add_sides') }}',
        type: "POST",
        dataType: 'json',
        data:{
            "_token": "{{ csrf_token() }}",
            'latitude[]':latitude,
            'longitude[]':longitude
        },
        cache: false,
        success: function(response){
            if (response['status'] == 1) {
                alert("success");
            }else{
                alert("Error");
            }
        }
    });


});

</script>
</html>