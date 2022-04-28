<table border="1">
    <thead>
        <tr>
            <th>Alphabet id</th>
            <th>Pasal</th>
            <th>Jenis Pelanggran</th>
            <th>Bunyi Pasal</th>
        </tr>
    </thead>
<tbody>
    @foreach($alphabets as $alphabet)
        <tr>
            <!-- <td>{{  $loop->iteration }}</td> -->
            <td>{{ $alphabet->id}}</td>
            <?php 
                //Mencari pelanggaran saat ini
                $sel_alphabet = DB::table('alphabets')->find($alphabet->id);
                $sel_paragraph = DB::table('paragraphs')->find($sel_alphabet->paragraph_id);
                $sel_article = DB::table('articles')->find($sel_paragraph->article_id);
            ?>
            <td>{{ $sel_article->article. " " . $sel_paragraph->paragraph . " " . $sel_alphabet->alphabet }}</td>
            <td>{{  $sel_paragraph->type_of_verse  }}</td>
            <td>{{  $sel_alphabet->alphabet_sound  }}</td>

        </tr>
    @endforeach
    </tbody>
</table>