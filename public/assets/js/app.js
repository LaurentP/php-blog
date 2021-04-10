"use strict"

// NavBar

const navBarButton = document.querySelector('.navbar-button')
const navBarMenu = document.querySelector('.navbar-menu')

if (navBarButton && navBarMenu) {

    navBarButton.addEventListener('click', () => {
        navBarMenu.classList.toggle('show')
    })

    document.querySelector('.container').addEventListener('click', () => {
        navBarMenu.classList.remove('show')
    })

}


// Image upload

const imageFileInput = document.getElementById('imageFileInput')
const imageFileText = document.querySelector('.file-upload-text')
const imagePreview = document.querySelector('.image-preview')
const deleteImage = document.getElementById('deleteImage')

if (imageFileInput && imageFileText && imagePreview) {

    const resetImage = () => {
        imageFileInput.files = null
        imageFileInput.value = null
        imagePreview.innerHTML = null
        imageFileText.innerHTML = 'No file chosen'
    }

    imageFileInput.addEventListener('change', e => {
        const file = e.target.files[0]
        if (!/\.(gif|jpg|jpeg|png)$/i.test(file.name)) {
            resetImage()
            return
        }
        imageFileText.innerHTML = file.name
        const fileReader = new FileReader()
        fileReader.addEventListener('load', e => {
            imagePreview.innerHTML = `<img src="${e.target.result}" alt=""><br><br><a href="#" class="image-preview-delete">Delete</a><br><br>`
            document.querySelector('.image-preview-delete').addEventListener('click', e => {
                e.preventDefault()
                resetImage()
            })
        })
        fileReader.readAsDataURL(file)
    })

    if (imageIsDisplayed) {
        document.querySelector('.image-preview-delete').addEventListener('click', e => {
            e.preventDefault()
            resetImage()
            // Cette valeur sert dans le formulaire d'édition à déterminer avec PHP si l'image de l'article déjà existant devra être supprimée ou non.
            if (deleteImage) deleteImage.value = true
        })
        imageIsDisplayed = false
    }

}


// LightBox

const lightBoxItem = document.querySelector('.lightbox-item')
const lightBox = document.querySelector('.lightbox')

if (lightBoxItem && lightBox) {

    lightBoxItem.addEventListener('click', () => {
        lightBox.classList.add('lightbox-show')
    })

    document.querySelector('.lightbox-close').addEventListener('click', () => {
        lightBox.classList.remove('lightbox-show')
    })
    
}