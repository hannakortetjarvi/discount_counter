// https://on.cypress.io/api

describe('Visit page', () => {
  it('should visit root', () => {
    cy.visit('/')
    cy.contains('h1', 'Discount Counter')
  })

  it('should visit discounts', () => {
    cy.visit('/discounts')
    cy.contains('p', 'Discounts')
  })

  it('should visit data', () => {
    cy.visit('/data')
    cy.contains('p', 'Data')
  })
})

describe('Select item', () => {
  it('select item from select component', () => {
    cy.visit('/discounts')
    cy.get('select.selectItem').select('sales')
    cy.get('select.selectItem').should('have.value', 'sales')
  })
})
