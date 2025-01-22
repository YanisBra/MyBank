// src/components/ExpensesList.js
import React, { useEffect, useState } from "react";
import { fetchExpenses, fetchCategory } from "../services/expensesService";

const ExpensesList = () => {
  const [expenses, setExpenses] = useState([]);
  const [category, setCategory] = useState([]);

  useEffect(() => {
    const loadExpenses = async () => {
      try {
        const data = await fetchExpenses();
        setExpenses(data);
        console.log(expenses);
      } catch (error) {
        console.error("Error fetching expenses:", error);
      }
    };

    loadExpenses();
  }, []);

  useEffect(() => {
    const loadCategory = async () => {
      try {
        const data = await fetchCategory();
        setCategory(data);
      } catch (error) {
        console.error("Error fetching category:", error);
      }
    };

    loadCategory();
  }, []);

  return (
    <div>
      <h1>Expenses</h1>
      <ul>
        {expenses.map((expense) => (
          <li key={expense.id}>
            {expense.id} - {expense.description} - ${expense.amount} - Category
            : ${expense.category}
          </li>
        ))}
      </ul>
      <h1>Category</h1>
      <ul>
        {category.map((categorie) => (
          <li key={categorie.id}>
            {categorie.id}- {categorie.title}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default ExpensesList;
