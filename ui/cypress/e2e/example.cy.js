// https://on.cypress.io/api

describe('Visit page', () => {
  it('should visit root', () => {
    cy.visit('/')
    cy.contains('h1', 'Discount Counter')
  })

  it('select item', () => {
    cy.visit('/')
    cy.get('selection').select('Sales')
    cy.get('selection').should('have.value', 'Sales')
  })
})
