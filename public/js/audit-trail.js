

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
        'App\\Bank': {
            name: 'Bank',
            fields: {
                'name': 'Name',
                'status': 'Status',
                'bank_code': 'Bank Code',
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
        'App\\CompanyTravelAllowance': {
            name: 'Company Travel Allowance',
            fields: {
                'company_id': 'Company ID',
                'rate': 'Rate',
                'country_id': 'Country ID',
                'code': 'Code',
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
        'App\\LeaveType': {
            name: 'Leave Type',
            fields: {
                'code': 'Code',
                'description': 'Description',
                'name': 'Name',
                'is_custom': 'Is Custom',
                'entitled_days': 'Entitled Days',
                'active': 'Active',
                'created_by': 'Created by',
            },
        },
        'App\\Media': {
            name: 'Media',
            fields: {
                'category': 'Category',
                'mimetype': 'Mimetype',
                'size': 'Size',
                'filename': 'Filename',
                'id': 'ID',
                'data': 'Data',
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
        'App\\User': {
            name: 'User',
            fields: {
                'remember_token': 'Remember Token',
                'name': 'Name', 
                'email': 'Email', 
                'password': 'Password',
                'profile_media_id': 'Profile Media ID',
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
                'id': 'ID',
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
                'id': 'ID',
                'attachment_media_id': 'Attachment Media ID',
                'created_by': 'Created by',
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