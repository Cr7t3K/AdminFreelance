window.addEventListener("DOMContentLoaded", () => {
    let deleteButton = document.querySelector('#deleteButton');
    let cancelButton = document.querySelector('#cancelButton');
    let deleteModal = document.querySelector('#deleteModal');

    const toggleModal = (modal) =>
    {
        modal.classList.toggle('hide');
        modal.classList.toggle('show');
    }

    deleteButton.addEventListener('click', event => {
        event.preventDefault();
        toggleModal(deleteModal);
    });

    cancelButton.addEventListener('click', event => {
        event.preventDefault();
        toggleModal(deleteModal);
    });
});