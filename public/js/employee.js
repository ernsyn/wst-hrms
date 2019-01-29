    //Add/Edit Employee: EPF Category and Socso Category Tooltip
$('#epfCategory').tooltip({
    title: "<p><b>Category A</b><br>"
    	+"Pekerja yang berikut sehingga pekerja itu mencapai umur enam puluh tahun:<br>"
    	+"(a) pekerja yang merupakan warganegara Malaysia;<br>"
    	+"(b) pekerja yang bukan warganegara Malaysia tetapi merupakan pemastautin tetap di Malaysia; dan<br>"
    	+"(c) pekerja yang bukan warganegara Malaysia yang memilih untuk mencarum sebelum 1 Ogos 1998.</p>"

    	+"<p><b>Category B</b><br>"
    	+"Pekerja yang berikut sehingga pekerja itu mencapai umur enam puluh tahun:<br>"
    	+"(a) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum pada atau selepas 1 Ogos 1998;<br>"
    	+"(b) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 3 Jadual Pertama pada atau selepas 1 Ogos 1998; dan<br>"
    	+"(c) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 6 Jadual Pertama pada atau selepas 1 Ogos 2001.</p>"
    		                                
    	+"<p><b>Category C</b><br>"
    	+"Pekerja yang berikut yang telah mencapai umur enam puluh tahun:<br>"
    	+"(a) pekerja bukan warganegara Malaysia tetapi merupakan pemastautin tetap di Malaysia; dan<br>"
    	+"(b) pekerja bukan warganegara Malaysia yang memilih untuk mencarum sebelum 1 Ogos 1998. </p>"                               
    		          
    	+"<p><b>Category D</b><br>"
    	+"Pekerja yang berikut yang telah mencapai umur enam puluh tahun:<br>"
    	+"(a) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum pada atau selepas 1 Ogos 1998;<br>"
    	+"(b) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 3 Jadual Pertama pada atau selepas 1 Ogos 1998; dan<br>"
    	+"(c) pekerja yang bukan warganegara Malaysia dan telah memilih untuk mencarum di bawah perenggan 6 Jadual Pertama pada atau selepas 1 Ogos 2001. </p>"

    	+"<p><b>Category E</b><br>"
    	+"Pekerja warganegara Malaysia yang telah mencapai umur enam puluh tahun.</p>", 
    html: true,
	placement: 'right',
}); 

$('#socsoCategory').tooltip({
    title: "<p><b>First Category</b><br>"
    	+"All employees who have not reached the age of 60, must contribute under the First Category except for those who have attained 55 years of age and have no prior contributions before they reach 55 due to non-eligibility under the Employees' Social Security Act, 1969.</p>"
    	+"<p><b>Second Category</b><br>"
    	+"All employees who have reached the age of 60 must be covered under this category for the Employment Injury Scheme only.<br>"
    	+"For eligible new employees who are 55 years of age, they must be covered under the Second Category.</p>", 
    html: true,
	placement: 'right',
});