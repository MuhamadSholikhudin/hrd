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
    @foreach($promotions as $promotion)
        <tr>
            <td>{{  $loop->iteration }}</td>
            <td>{{ $promotion->employee->number_of_employees}}</td>
            <td>{{ $promotion->employee->name}}</td>
            <td>{{ $promotion->job->job_level	}}</td>
            <td>{{ $promotion->department->department	}}</td>
            <td>{{ $promotion->cell	}}</td>
            <td>{{ $promotion->bagian	}}</td>
            <td>{{ $promotion->promotion_date	}}</td>
        </tr>
    @endforeach
    </tbody>
</table>