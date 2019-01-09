$(function() 
{
    var availableScripts = <?php include('autocomplete.php'); ?>;
    $(".search").autocomplete(
    {
        source: availableScripts,
        autoFocus:true
    });
});