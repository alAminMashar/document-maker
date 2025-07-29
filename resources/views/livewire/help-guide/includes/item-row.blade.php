<tr>
    <td class="text-wrap">
        {{ $article->subTopic->topic['title'] }}
    </td>
    <td class="text-wrap">
        {{ $article->subTopic['title'] }}
    </td>
    <td class="text-wrap">
        {{ $article->title }}
    </td>
    <td class="text-wrap">
        @include('livewire.help-guide.includes.actions')
    </td>
</tr>
