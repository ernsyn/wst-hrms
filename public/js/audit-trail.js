

var AuditTrail = (function() {
    var displayNamesMatrix = {
        'App\\LeaveType': {
            name: 'Leave Type',
            fields: {
                'code': 'Code',
                'description': 'Description',
                'name': 'Name',
            },
        },
        'App\\Employee': {
            name: 'Employee',
            fields: {

            },
        },
        'App\\Media': {
            name: 'Media',
            fields: {

            },
        },
        'App\\Eis': {
            name: 'EIS',
            fields: {

            },
        },
        'App\\EmployeeJob': {
            name: 'Employee Job',
            fields: {

            },
        },
        'App\\EmployeeWorkingDay': {
            name: 'Employee Working Days',
            fields: {

            },
        },
        'App\\EmployeeDependent': {
            name: 'Employee Dependent',
            fields: {

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