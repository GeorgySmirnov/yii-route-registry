<?php

/* @var $this yii\web\View */

$this->title = 'Route registry';
?>

<?php $this->beginBlock('head'); ?>
<link type="text/css" rel="stylesheet" href="css/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="css/jsgrid-theme.min.css" />

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/jsgrid.min.js"></script>
<?php $this->endBlock(); ?>

<div id="jsGrid"></div>
<script>
 $(function() {
     
     $("#jsGrid").jsGrid({
         width: "100%",
         
         filtering: false,
         inserting: true,
         editing: true,
         sorting: false,
         paging: false,
         autoload: true,
         
         controller: {
             loadData: function(filter) {
                 return $.ajax({
                     type: "GET",
                     url: "/routes",
                     data: filter
                 });
             },
             
             insertItem: function(item) {
                 return $.ajax({
                     type: "POST",
                     url: "/routes",
                     data: item
                 });
             },
             
             updateItem: function(item) {
                 return $.ajax({
                     type: "PUT",
                     url: "/routes/" + item.id,
                     data: item
                 });
             },
             
             deleteItem: function(item) {
                 return $.ajax({
                     type: "DELETE",
                     url: "/routes/" + item.id,
                     data: item
                 });
             },
         },
         
         fields: [
             { name: "id", type: "number", width: 20 },
             { name: "origin", type: "text", width: 100 },
             { name: "departureStr", type: "text", width: 50 },
             { name: "destination", type: "text", width: 100 },
             { name: "arrivalStr", type: "text", width: 50 },
             { name: "longevityStr", type: "text", width: 50 },
             { name: "price", type: "text", width: 50 },
             { name: "scheduleStr", type: "text", width: 100},
             { type: "control" }
         ]
     });
     
 });
</script>
