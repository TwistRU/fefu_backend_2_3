<script type="text/javascript">
    let isAccepted = confirm("Хотите оставить отзыв?");
    if (isAccepted) {
        let url = new URL("{{ route("appeal") }}");
        url.searchParams.append("suggested", "1");
        window.location.href = url;
    }
</script>
