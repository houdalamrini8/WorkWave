document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const steps = document.querySelectorAll('.step');
    const stepContainers = document.querySelectorAll('.step-container');

    function goToStep(step) {
        currentStep = step;
        updateDisplay();
    }

    function updateDisplay() {
        console.log(`Current step: ${currentStep}`); 
        
      
        steps.forEach(step => {
            const stepNum = parseInt(step.getAttribute('data-step'));
            step.classList.toggle('active', stepNum <= currentStep);
        });

        stepContainers.forEach(container => {
            const containerStep = parseInt(container.getAttribute('data-step'));
            container.classList.toggle('active', containerStep === currentStep);
        });
    }


    window.nextStep = function() {
        if (currentStep < steps.length) goToStep(currentStep + 1);
    };

    window.prevStep = function() {
        if (currentStep > 1) goToStep(currentStep - 1);
    };

 
    updateDisplay();
});