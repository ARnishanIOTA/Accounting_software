onChangeContact:function(e){
    var t=this;
    !this.edit.status||this.edit.currency ? axios.get(url+"/sales/customers/"+e+"/currency")
        .then((
            function(e){
                    t.form.contact_name=e.data.name,
                    t.form.contact_email=e.data.email,
                    t.form.contact_tax_number=e.data.tax_number,
                    t.form.contact_phone=e.data.phone,
                    t.form.contact_address=e.data.address,
                    t.form.currency_code=e.data.currency_code,
                    t.form.currency_rate=e.data.currency_rate
            }
            ))
        .catch((
            function(e){}))
        :this.edit.currency=!0
}