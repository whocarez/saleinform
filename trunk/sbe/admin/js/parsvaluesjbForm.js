function parsvaluesjbForm(name) 
{
   parsvaluesForm.prototype.jbForm = jbForm;
   this.jbForm(name);
}

parsvaluesjbForm.inheritsFrom(jbForm);

function SetFilterValue() 
{
   var filterCombo = $("bctrl_value_edit");
   var filter = $("bctrl_value");
   filter.value = filterCombo.value;
}
