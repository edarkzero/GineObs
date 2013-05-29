
function dialogCalendarOpciones(idDiv)
{
    $( idDiv ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": function() {

        },

        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        //allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
}