

var AuditTrail = (function() {
    var displayNamesMatrix = {
        'App\\Addition': {
            name: 'Addition',
            fields: {
                'code': 'Code',
                'name': 'Name',
                'type': 'Type',
                'amount': 'Amount',
                'statutory': 'Statutory',
                'status': 'Status',
                'company_id': 'Company ID',
                'ea_form_id': 'EA Form ID',
                'confirmed_employee': 'Confirmed Employee',
                'cost_centre': 'Cost Centre',
                'employee_grade': 'Employee Grade',
                'created_by': 'Created by'
            },
        },

        'App\\BankCode': {
            name: 'Bank Code',
            fields: {
                'name': 'Name',
                'status': 'Status',
                'bank_code': 'Bank Code',
            },
        },
        'App\\Branch': {
            name: 'Branch',
            fields: {
                'name': 'Name',
                'contact_no_primary': 'Primary Contact No',
                'contact_no_secondary': 'Secondary Contact No',
                'fax_no': 'Fax No',
                'address': 'Address',
                'address2': 'Address 2',
                'address3': 'Address 3',
                'country_code': 'Country Code',
                'state': 'State',
                'city': 'City',
                'zip_code': 'ZIP Code'
            },
        },
        'App\\Company': {
            name: 'Company',
            fields: {
                'name': 'Name',
                'url': 'URL',
                'registration_no': 'Registration No',
                'description': 'Description',
                'address': 'Address',
                'address2': 'Address 2',
                'address3': 'Address 3',
                'phone': 'Phone',
                'tax_no': 'Tax No',
                'epf_no': 'EPF No',
                'socso_no': 'SOCSO No',
                'eis_no': 'EIS No',
                'code': 'Code',
                'status': 'Status',
            },
        },
        'App\\CompanyBank': {
            name: 'Company Bank',
            fields: {
                'company_id': 'Company ID' ,
                'bank_code': 'Bank Code',
                'acc_name': 'Account Name',
                'status': 'Status',
                'created_by': 'Created by',
            },
        },
        'App\\CostCentre': {
            name: 'Cost Centre',
            fields: {
                'name': 'Name',
                'seniority_pay': 'Seniority Pay',
                'amount': 'Amount',
                'created_by': 'Created by',
            },
        },
        'App\\Deduction': {
            name: 'Deduction',
            fields: {
                'code': 'Code',
                'name': 'Name',
                'type': 'Type',
                'amount': 'Amount',
                'statutory': 'Statutory',
                'status': 'Status',
                'company_id': 'Company ID',
                'created_by': 'Created by',
                'ea_form_id': 'EA Form ID',
                'confirmed_employee': 'Confirmed Employee',
                'cost_centre': 'Cost Centre',
                'employee_grade': 'Employee Grade',
            },
        },
        'App\\Department': {
            name: 'Department',
            fields: {
                'name': 'Name',
                'created_by': 'Created by',
            },
        },
        'App\\Eis': {
            name: 'EIS',
            fields: {
                'employer': 'Employee',
                'employee': 'Employer',
                'salary': 'Salary',
                'created_by': 'Created by',
            },
        },
        'App\\Employee': {
            name: 'Employee',
            fields: {
                'user_id': 'User ID',
                'address': 'Address',
                'address2': 'Address 2',
                'address3': 'Address 3',
                'company_id': 'Company ID',
                'contact_no': 'Contact No',
                'dob': 'D.O.B',
                'gender': 'Gender',
                'race': 'Race',
                'nationality': 'Nationality',
                'marital_status': 'Marital Status',
                'total_children': 'Total children',
                'ic_no': 'IC No',
                'tax_no': 'Tax No',
                'epf_no': 'EPF No',
                'eis_no': 'EIS No',
                'socso_no': 'SOCSO No',
                'driver_license_no': 'Driver license No',
                'driver_license_expiry_date': 'Driver License Expiry Date',
                'created_by': 'Created by',
                'main_security_group_id': 'Main Security Group ID',
                'code': 'Code',
                'resignation_date': 'Resignation Date',
            },
        },
        'App\\EmployeeAttachment': {
            name: 'Employee Attachment',
            fields: {
                'name': 'Name',
                'notes': 'Notes',
                'media_id': 'Media ID',
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeAttendance': {
            name: 'Employee Attendance',
            fields: {
                'emp_id': 'Employee ID',
                'date': 'Date',
                'attendance': 'Attendance',
            },
        },
        'App\\EmployeeBankAccount': {
            name: 'Employee Bank Account',
            fields: {
                'bank_code': 'Bank Code',
                'acc_no': 'Account No',
                'acc_status': 'Account Status',
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeClockInOutRecord': {
            name: 'Employee Clock In Out Record',
            fields: {
                'clock_in_time': 'Clock In Time',
                'clock_in_lat': 'Clock In Latitude',
                'clock_in_long': 'Clock In Longitude',
                'clock_in_address': 'Clock In Address',
                'clock_in_status': 'Clock In Status',
                'clock_in_reason': 'Clock In Reason',
                'clock_out_time': 'Clock Out Time',
                'clock_out_lat': 'Clock Out Latitude',
                'clock_out_long': 'Clock Out Longitude',
                'clock_out_address': 'Clock Out Address',
                'clock_out_status': 'Clock Out Status',
                'clock_out_reason': 'Clock Out Reason',
            },
        },
        'App\\EmployeeDependent': {
            name: 'Employee Dependent',
            fields: {
                'name': 'Name',
                'relationship': 'Relationship',
                'dob': 'D.O.B',
                'created_by': 'Created by',
            },
        },

        'App\\EmployeeEducation': {
            name: 'Employee Education',
            fields: {
                'emp_id': 'Employee ID',
                'institution': 'Institution',
                'level': 'Level',               
                'start_year': 'Start Year',
                'end_year': 'End Year', 
                'gpa': 'GPA', 
                'description': 'Description',
                'major':'Major',
                'note':'Note',    
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeEmergencyContact': {
            name: 'Employee Emergency Contact',
            fields: {
                'emp_id': 'Employee ID',
                'name': 'Name',
                'relationship': 'Relationship',               
                'contact_no': 'Contact No',   
                'created_by': 'Created by',
            },
        },

        'App\\EmployeeExperience': {
            name: 'Employee Experience',
            fields: {
                'emp_id': 'Employee ID',
                'company': 'Company',
                'position': 'Position',               
                'start_date': 'Start Date',
                'end_date': 'End Date', 
                'notes':'Note',    
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeGrade': {
            name: 'Employee Grade',
            fields: {
                'name': 'Name',
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeImmigration': {
            name: 'Employee Immigration',
            fields: {
                'emp_id': 'emp_id',
                'document_media_id': 'Document Media ID',
                'passport_no': 'Passport No',
                'expiry_date': 'Expiry Date',
                'issued_by': 'Issued By',
                'issued_date': 'Issued Date',
                'created_by': 'Created By',
            },
        },
        'App\\EmployeeJob': {
            name: 'Employee Job',
            fields: {
                'branch_id': 'Branch ID',
                'emp_mainposition_id': 'Employee Main Position ID',
                'department_id': 'Department ID',
                'team_id': 'Team ID',
                'cost_centre_id': 'Cost Centre ID',
                'emp_grade_id': 'Employee Grade ID',
                'start_date': 'Start Date',
                'end_date': 'End Date',
                'basic_salary': 'Basic Salary',
                'remarks': 'Remarks',
                'status': 'Status',
                'created_by': 'Created By',
            },
        },

        'App\\EmployeePosition': {
            name: 'Employee Position',
            fields: {
                'name': 'Name',
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeReportTo': {
            name: 'Employee Report To',
            fields: {
                'report_to_emp_id': 'Report To Employee ID',
                'type': 'Type',
                'report_to_level': 'Report To Level',
                'kpi_proposer': 'KPI Proposer',
                'notes': 'Notes',
                'created_by': 'Created by',
                'emp_id': 'Employee ID',
        
            },
        },
        'App\\EmployeeSecurityGroup': {
            name: 'EPF',
            fields: {
                'emp_id': 'Employee ID',
                'security_group_id': 'Security Group ID',
                'payroll_access': 'Payroll Access',               
                'created_by': 'Created by',
            },
        },
        'App\\EmployeeSkill': {
            name: 'Employee Skill',
            fields: {
                'emp_id': 'emp_id',
                'name': 'Name',
                'years_of_experience': 'Years Of Experience',
                'competency': 'Competency',
                'created_by': 'Created By',
            },
        },
        'App\\EmployeeVisa': {
            name: 'Employee Visa',
            fields: {
                'emp_id': 'emp_id',
                'document_media_id': 'Document Media ID',
                'type': 'Type',
                'family_members':'Family Members',
                'visa_number': 'Visa Number',
                'expiry_date': 'Expiry Date',
                'issued_by': 'Issued By',
                'issued_date': 'Issued Date',
                'created_by': 'Created By',
            },
        },
        'App\\EmployeeWorkingDay': {
            name: 'Employee Working Days',
            fields: {
                'is_template': 'Is Template',
                'start_work_time': 'Full Day - Start Work Time',
                'end_work_time': 'Full Day - End Work Time',
                'half_1_start_work_time': 'Half Day 1 - Start Work Time',
                'half_1_end_work_time': 'Half Day 1 - End Work Time',
                'half_2_start_work_time': 'Half Day 2 - Start Work Time',
                'half_2_end_work_time': 'Half Day 2 - End Work Time',
                'emp_id': 'Employee ID',
                'template_name': 'Template Name',
                'monday': 'Monday',
                'tuesday': 'Tuesday',
                'wednesday': 'Wednesday',
                'thursday': 'Thursday',
                'friday': 'Friday',
                'saturday': 'Saturday',
                'sunday': 'Sunday',
                'created_by': 'Created by',
            },
        },
        'App\\EPF': {
            name: 'EPF',
            fields: {
                'name': 'Name',
                'category': 'Category',
                'employee': 'Employee',     
                'employer': 'Employer',             
                'created_by': 'Created by',
                'salary' :'Salary',
            },
        },
 
        'App\\Holiday': {
            name: 'Holiday',
            fields: {
                'name': 'Name',
                'start_date': 'Start Date',
                'end_date': 'End Date',
                'total_days': 'Total Days',
                'repeated_annually': 'Repeated Annually',
                'status': 'Status',
                'note': 'Note',
                'state': 'State',             
                'created_by': 'Created by',
            },
        },

        'App\\LeaveRequest': {
            name: 'Leave Request',
            fields: {
                'emp_id': 'Employee ID',
                'leave_type_id': 'Leave Type ID',
                'leave_allocation_id': 'Leave Allocation ID',
                'start_date': 'Start Date',
                'end_date': 'End Date',
                'am_pm': 'AM/PM',
                'applied_days': 'Applied Days',
                'reason': 'Reason',
                'status': 'Status',
                'attachment_media_id': 'Attachment Media ID',
                'created_by': 'Created by',
            },
        },
        'App\\LeaveRequestApproval': {
            name: 'Leave Request Approval',
            fields: {
                'approved_by_emp_id': 'Approved By Employee ID',
                'leave_request_id': 'Leave Request ID',
                'created_by': 'Created by',
            },
        },
        'App\\LeaveType': {
            name: 'Leave Type',
            fields: {
                'code': 'Code',
                'name': 'Name',
                'description': 'Description',
                'is_custom': 'Is Custom',
                'entitled_days': 'Entitled Date',
                'active': 'Active',
                'created_by': 'Created by',
            },
        },

        'App\\LTAppliedRule': {
            name: 'LT Applied Rule',
            fields: {
                'rule': 'Rule',
                'configuration': 'Description',
                'created_by': 'Created by',
            },
        },

        'App\\LTConditionalEntitlement': {
            name: 'LT Condition Entitlement',
            fields: {
                'min_years': 'Min Years',
                'entitled_days': 'Entitled Days',
            },
        },

        'App\\LTEntitlementGradeGroup': {
            name: 'LT Entitlement Grade Group',
            fields: {
                'entitled_days': 'Entitled Days',
                'leave_type_id': 'Leave Type ID',

            },
        },

        'App\\Media': {
            name: 'Media',
            fields: {
                'category': 'Category',
                'mimetype': 'Mimetype',
                'data': 'Data',
                'size': 'Size',
                'filename': 'File Name',

            },
        },
        'App\\Pcb': {
            name: 'PCB',
            fields: {
                'category': 'Category',
                'total_children': 'Total Children',
                'salary': 'Salary',
                'amount': 'Amount',
                'created_by': 'Created by',
            },
        },
        'App\\SecurityGroup': {
            name: 'Security Group',
            fields: {
                'name': 'Name',
                'description': 'Description',
                'company_id': 'Company id',
                'created_by': 'Created by',
            },
        },

        'App\\Socso': {
            name: 'Socso',
            fields: {
                'first_category_employer': 'First Category Employer',
                'first_category_employee': 'First Category Employee',
                'salary': 'Salary',
                'created_by': 'Created by',
            },
        },

        'App\\TaskStatus': {
            name: 'Task Statu',
            fields: {
                'task': 'Task',
                'status': 'Status',
            },
        },

        'App\\Team': {
            name: 'Team',
            fields: {
                'name': 'Name',
                'created_by': 'Created by',
            },
        },

        'App\\User': {
            name: 'User',
            fields: {
                'name': 'Name',
                'email': 'Email',
                'password': 'Password',
      
            },
        },
        
        'App\\PayrollSetup': {
            name: 'Payroll Setup',
            fields: {
                'key': 'Key',
                'value': 'Value',
                'remark': 'Remark',
                'status': 'Status',
                'created_by': 'Created by',
                'updated_by': 'Updated by'
      
            },
        },
        
        'App\\PayrollMaster': {
            name: 'Payroll',
            fields: {
                'year_month': 'Payroll Month',
                'period': 'Payroll Period',
                'start_date': 'Start Date',
                'end_date': 'End Date',
                'status': 'Status',
                'created_by': 'Created by',
                'updated_by': 'Updated by'
            },
        },
        
        'App\\PayrollTrx': {
            name: 'Payroll Trx',
            fields: {
                'key': 'Key',
                'value': 'Value',
                'remark': 'Remark',
                'status': 'Status',
                'created_by': 'Created by',
                'updated_by': 'Updated by'
      
            },
        },
        
        'App\\PayrollTrxAddition': {
            name: 'Payroll Addition',
            fields: {
                'key': 'Key',
                'value': 'Value',
                'remark': 'Remark',
                'status': 'Status',
                'created_by': 'Created by',
                'updated_by': 'Updated by'
      
            },
        },
        
        'App\\PayrollTrxDeduction': {
            name: 'Payroll Deduction',
            fields: {
                'key': 'Key',
                'value': 'Value',
                'remark': 'Remark',
                'status': 'Status',
                'created_by': 'Created by',
                'updated_by': 'Updated by'
      
            },
        },
        
        'App\\Role': {
            name: 'Role',
            fields: {
                'name': 'Role Name',
                'description': 'Description',
            },
        },
        
        'App\\JobCompany': {
            name: 'Job Company',
            fields: {
                'company_name': 'Company Name',
            },
        },
        
        'App\\Section': {
            name: 'Section',
            fields: {
                'name': 'Section Name',
            },
        },
        
        'App\\Area': {
            name: 'Area',
            fields: {
                'name': 'Area Name',
            },
        },
        
        'App\\Category': {
            name: 'Category',
            fields: {
                'name': 'Category Name',
            },
        },
        
        'App\\EmploymentStatus': {
            name: 'Employment Status',
            fields: {
            },
        },
        
        'App\\CompanyAsset': {
            name: 'Company Asset',
            fields: {
            	'item_code': 'Item Code',
            	'item_name': 'Item Name',
            },
        },
    };

    return {
        getModelDisplayNamesSection: function(modelName) {
            if(displayNamesMatrix.hasOwnProperty(modelName)) {
                return displayNamesMatrix[modelName];
            }
        },
        getModelFieldName:function(modelDisplayNames, field) {
            if(modelDisplayNames.fields.hasOwnProperty(field)) {
                return modelDisplayNames.fields[field];
            }
    
            return field;
        }
    }
})();