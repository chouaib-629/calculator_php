/** This code generates and appends a specified number of random operator signs to the element with the class 'operator-background'.
It uses a for loop to create and style each sign, setting its text content, position, font size, and rotation to random values. */


// Add an event listener to the document's DOMContentLoaded event
document.addEventListener('DOMContentLoaded', () => {
    // Define an array of operators for the calculator
    const operators = ['+', '-', '*', '/'];
    
    // Select the element with the class 'operator-background'
    const operatorBackground = document.querySelector('.operator-background');
    
    // Define the number of operator signs to generate
    const numberOfSigns = 100; // Adjust the number of signs as needed
    
    // Loop through the number of signs to generate
    for (let i = 0; i < numberOfSigns; i++) {
      // Create a new div element for the operator sign
      const sign = document.createElement('div');
      
      // Add the 'operator-sign' class to the sign element
      sign.classList.add('operator-sign');
      
      // Set the text content of the sign element to a random operator
      sign.textContent = operators[Math.floor(Math.random() * operators.length)];
      
      // Set the top and left styles of the sign element to random values
      sign.style.top = `${Math.random() * 100}vh`;
      sign.style.left = `${Math.random() * 100}vw`;
      
      // Set the font size of the sign element to a random value between 10px and 50px
      sign.style.fontSize = `${Math.random() * 40 + 10}px`; 
      
      // Set the rotation of the sign element to a random value between 0 and 360 degrees
      sign.style.transform = `rotate(${Math.random() * 360}deg)`; 
      
      // Append the sign element to the operator background element
      operatorBackground.appendChild(sign);
    }
  });