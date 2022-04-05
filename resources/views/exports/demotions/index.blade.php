<table border="1">
    <thead>
        <tr>
            <th>NO</th>
            <th>number_of_employees</th>
            <th>name</th>
            <th>job_level	</th>
            <th>department	</th>
            <th>cell	</th>
            <th>bagian	</th>
            <th> Tanggal Promosi </th>
        </tr>
    </thead>
<tbody>
    @foreach($demotions as $demotion)
        <tr>
            <td>{{  $loop->iteration }}</td>
            <td>{{ $demotion->employee->number_of_employees}}</td>
            <td>{{ $demotion->employee->name}}</td>
            <td>{{ $demotion->job->job_level	}}</td>
            <td>{{ $demotion->department->department	}}</td>
            <td>{{ $demotion->cell	}}</td>
            <td>{{ $demotion->bagian	}}</td>
            <td>{{ $demotion->demotion_date	}}</td>
        </tr>
    @endforeach
    </tbody>
</table>