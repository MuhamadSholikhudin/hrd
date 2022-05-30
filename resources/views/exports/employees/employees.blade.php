<table border="1">
    <thead>
        <tr>
            <th>NO</th>
            <th>number_of_employees</th>
            <th>name</th>
            <th>gender</th>
            <th>place_of_birth	</th>
            <th>date_of_birth	</th>
            <th>marital_status	</th>
            <th>religion	</th>
            <th>biological_mothers_name	</th>
            <th>national_id	</th>
            <th>address_jalan	</th>
            <th>address_rt	</th>
            <th>address_rw	</th>
            <th>address_village	</th>
            <th>address_district	</th>
            <th>address_city	</th>
            <th>address_province	</th>
            <th>phone	</th>
            <th>email	</th>
            <th>npwp	</th>
            <th>bank_name	</th>
            <th>bank_branch	</th>
            <th>bank_account_name	</th>
            <th>bank_account_number	</th>
            <th>bpjs_ketenagakerjaan</th>	
            <th>bpjs_kesehatan	</th>
            <th>hire_date	</th>
            <th>employee_type	</th>
            <th>end_of_contract	</th>
            <th>date_out	</th>
            <th>exit_statement	</th>
            <th>job_level	</th>
            <th>department	</th>
            <th>cell	</th>
            <th>bagian	</th>
            <th>kode_ptkp	</th>
            <th>year_ptkp	</th>
            <th>educate	</th>
            <th>major</th>
        </tr>
    </thead>
<tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{  $loop->iteration }}</td>
            <td>{{ $employee->number_of_employees}}</td>
            <td>{{ $employee->name}}</td>
            <td>{{ $employee->gender}}</td>
            <td>{{ $employee->place_of_birth }}</td>
            <td>{{ $employee->date_of_birth	}}</td>
            <td>{{ $employee->marital_status	}}</td>
            <td>{{ $employee->religion	}}</td>
            <td>{{ $employee->biological_mothers_name	}}</td>
            <td>{{ $employee->national_id	}}</td>
            <td>{{ $employee->address_jalan	}}</td>
            <td>{{ $employee->address_rt	}}</td>
            <td>{{ $employee->address_rw	}}</td>
            <td>{{ $employee->address_village	}}</td>
            <td>{{ $employee->address_district	}}</td>
            <td>{{ $employee->address_city	}}</td>
            <td>{{ $employee->address_province	}}</td>
            <td>{{ $employee->phone	}}</td>
            <td>{{ $employee->email	}}</td>
            <td>{{ $employee->npwp	}}</td>
            <td>{{ $employee->bank_name	}}</td>
            <td>{{ $employee->bank_branch	}}</td>
            <td>{{ $employee->bank_account_name	}}</td>
            <td>{{ $employee->bank_account_number	}}</td>
            <td>{{ $employee->bpjs_ketenagakerjaan}}</td>	
            <td>{{ $employee->bpjs_kesehatan	}}</td>
            <td>{{ $employee->hire_date	}}</td>
            <td>{{ $employee->employee_type	}}</td>
            <td>{{ $employee->end_of_contract	}}</td>
            <td>{{ $employee->date_out	}}</td>
            <td>{{ $employee->exit_statement	}}</td>
            <td>{{ jabatan($employee->id)}} </td>
            <td>{{ department($employee->id)}} </td>
            <td>{{ $employee->cell	}}</td>
            <td>{{ $employee->bagian	}}</td>
            <td>{{ $employee->kode_ptkp	}}</td>
            <td>{{ $employee->year_ptkp	}}</td>
            <td>{{ $employee->educate	}}</td>
            <td>{{ $employee->major}}</td>
        </tr>
    @endforeach
    </tbody>
</table>