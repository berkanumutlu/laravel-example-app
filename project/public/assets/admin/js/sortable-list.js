/*const sortable_list = document.querySelectorAll('.sortable-list')
const sortable_item = document.querySelectorAll('.sortable-item')

sortable_item.forEach(item => {
    item.addEventListener('dragstart', () => {
        item.classList.add('dragging')
    })

    item.addEventListener('dragend', (e) => {
        item.classList.remove('dragging')
    })
})

sortable_list[0].addEventListener('dragover', e => {
    e.preventDefault()
    const afterElement = getDragAfterElement(sortable_list[0], e.clientY)
    const item = document.querySelector('.dragging')
    if (afterElement == null) {
        sortable_list[0].appendChild(item)
    } else {
        sortable_list[0].insertBefore(item, afterElement)
    }
})

function getDragAfterElement(container, y) {
    const sortableElements = [...container.querySelectorAll('.sortable-item:not(.dragging)')]

    return sortableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect()
        const offset = y - box.top - box.height / 2
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child }
        } else {
            return closest
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element
}
*/
/**
 * sortable için jQuery UI eklenmesi gerekiyor.
 */
$(".sortable-list").sortable({
    items: ".sortable-item",
    revert: true,
    cursor: "move",
    tolerance: "pointer",
    axis: "y",
    start: function (event, ui) {
        ui.item[0].classList.add('dragging')
    },
    update: function (event, ui) {
        $(".sortable-list .sortable-item").each(function (index) {
            $(this).find('.sort').val(index + 1);
        });
    },
    stop: function (event, ui) {
        ui.item[0].classList.remove('dragging')
    }
});
$(".sortable-list").disableSelection();
