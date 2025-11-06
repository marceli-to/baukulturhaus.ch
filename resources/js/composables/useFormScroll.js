export function useFormScroll(selector = 'form') {
  const scrollToForm = () => {
    const formElement = document.querySelector(selector);

    if (formElement) {
      // Scroll to the element with some offset for better visibility
      formElement.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  };

  return {
    scrollToForm
  };
}
